<?php 
  class Comments extends CI_Controller{
    
    public function create(){
      // Find post that about to be commented
      $slug = $this->input->post('hidden_slug');
      $data['post'] = $this->Post_model->get_posts($slug); 
      $data['title'] = $data['post']->title;
      $data['comments'] = $this->Comment_model->get_comments($data['post']->id);
     
      $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
      $this->form_validation->set_rules('body', 'Comment', 'required|xss_clean');
    
      if ($this->form_validation->run() === FALSE) {
         $this->session->set_flashdata('errors', validation_errors());
         $this->load_pages('posts', 'single', $data);
      } else {
          $comment = [
            'post_id' => $data['post']->id,
            'comment_name'    => html_escape($this->input->post('name')),
            'comment_email'   => html_escape($this->input->post('email')),
            'comment_body'    => html_escape($this->input->post('body'))
          ];  
          
          $is_inserted = $this->Comment_model->create_comment($comment);
          
          if ($is_inserted) {
            $this->session->set_flashdata('comment_success', 'Your comment added successfully!');
            redirect('posts/single/'.$slug);
          } else {
            $this->session->set_flashdata('comment_fail', 'Your comment can not be created, please try again');
            redirect('posts/single/'.$slug);
          }        
          
      }
    }



  }