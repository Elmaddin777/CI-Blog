<?php

class Posts extends CI_Controller {
	public function index($offset = 0)
	{
		$config['base_url'] = base_url().'posts/index/';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');
		// Init
		$this->pagination->initialize($config);
		
		$data = [
			'title' => 'Latest Posts',
			'posts' =>  $this->Post_model->get_posts(FALSE , $config['per_page'], $offset)
		];
		
		$this->load_pages('posts', 'index' , $data);
	}
	
	public function single($slug = NULL){
			$post = $this->Post_model->get_posts($slug);
			// No slug then 404
			if (empty($post)) {
				show_404();
			}
			
			$comments = $this->Comment_model->get_comments($post->id);
			
			// Set data
			$data = [
				'title'    => $post->title,
				'post'     => $post,
				'comments' => $comments
			];
			
			$this->load_pages('posts', 'single', $data);				
	}
	
	public function create(){	
		// Check login
		if (! $this->session->userdata('logged_in')) {
			show_404();
		}
			
		$data['categories'] = $this->Post_model->get_categories();
		
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		
			$this->load_pages('posts', 'create', $data);
		
		} else {
			// Post request
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|is_unique[posts.title]|xss_clean');
			$this->form_validation->set_rules('body', 'Body', 'required|min_length[10]|xss_clean');
			
			$this->form_validation->set_message('is_unique', 'Title is already taken, please enter different title');
			// Validation no successfull go back
			if ($this->form_validation->run() === FALSE) {
				$this->load_pages('posts', 'create');
			} else {
			
				// Set img preferences
				$img_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);				
				$config['upload_path'] = './assets/img';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max-size'] = '2048';
				$config['max-width'] = '500';
				$config['max-height'] = '500';
				$config['file_name'] = time().'.'.$img_ext;
				$img_name = $config['file_name'];
				
				$this->load->library('upload', $config);
				
				if (! $this->upload->do_upload('img')) {
					$error = array('error' => $this->upload->display_errors()); 	
					$this->session->set_flashdata('post_fail', $error['error']);
					redirect('posts/create');
				} else {
					$data = array('upload_data' => $this->upload->data());
				}
				
				$data = [
					'user_id' =>$this->session->userdata('user_id'),
					'category_id' => html_escape($this->input->post('cat')),
					'title' => html_escape($this->input->post('title')),
					'body'  => $this->input->post('body'),
					'slug'  => html_escape(url_title($this->input->post('title'))),
					'img'   => $img_name
				];
				
				// Validation successfull, proceed to insert
				$is_inserted = $this->Post_model->create_post($data);
				if ($is_inserted) {
					$this->session->set_flashdata('insert_success', 'Post Created Successfully!');
					redirect('posts');
				} else {
					$this->session->set_flashdata('post_fail', 'Post Can Not Be Created, Please Try Again');
					redirect('posts/create');
				}
				
			}
			
		}

	}
	
	public function delete($id){
		// Get user data for auth
		$result = $this->Post_model->find_post_by_id($id);
		
		// Check user
		if ($result->user_id != $this->session->userdata('user_id')) {
			show_404();
		}
		
		// Check login
		if (! $this->session->userdata('logged_in')) {
			show_404();
		}
		
		// Right user then proceed to delete
		$is_deleted = $this->Post_model->delete_post($id);
		
		if ($is_deleted) {
			$this->session->set_flashdata('delete_success', 'Post Deleted Successfully');
			redirect('posts');
		} else {
			echo 'fail';
		}
	}
	
	public function edit($slug){
		// Check login
		if (! $this->session->userdata('logged_in')) {
			show_404();
		}
		
		$result = $this->Post_model->find_post($slug);
		
		// Check user
		if ($result->user_id != $this->session->userdata('user_id')) {
			show_404();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		
			$data = [
				'categories' => $this->Post_model->get_categories(),
				'post' => $result
			];
			
			if (!$data['post']) {
				show_404();
			} else {	
				$this->load_pages('posts', 'edit' , $data);
			}
			
		} else {
			// Post request
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('body', 'Body', 'required|min_length[10]|xss_clean');
			
			// Validation no successfull go back
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('update_fail', validation_errors());
				redirect('posts/edit/'.$result->id);
			} else {
				// Set img preferences
				$img_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);				
				$config['upload_path'] = './assets/img';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max-size'] = '2048';
				$config['max-width'] = '500';
				$config['max-height'] = '500';
				$config['file_name'] = time().'.'.$img_ext;
				$img_name = $config['file_name'];
				
				$this->load->library('upload', $config);
				
				if (! $this->upload->do_upload('img')) {
					$error = array('error' => $this->upload->display_errors()); 	
					$this->session->set_flashdata('post_fail', $error['error']);
					redirect('posts/create');
				} else {
					$data = array('upload_data' => $this->upload->data());
				}
				
				// Validation successfull, proceed to insert
				$data = [
					'category_id' => $this->input->post('cat'),
					'title' => html_escape($this->input->post('title')),
					'body'  => $this->input->post('body'),
					'slug'  => url_title($this->input->post('title')),
					'img'   => $img_name
				];
				$is_updated = $this->Post_model->update_post($result->id , $data);
				if ($is_updated) {
					$this->session->set_flashdata('update_success', 'Post edited successfully!');
					redirect('posts');
				} else {	
					$this->session->set_flashdata('update_fail', 'Post can not Be edited, please try again');
					redirect('posts');
				}
				
			}
			
		}

		
	}
	
	
	
}