<?php 
  class Categories extends CI_Controller{
  
    public function index(){
      $cats = $this->Category_model->get_categories();
      $data = [
        'title' => 'Categories',
        'cats'  => $cats
      ];
    
      $this->load_pages('categories', 'index' , $data);
    }
    
    public function single($slug, $offset = 0){
      $config['base_url'] = base_url() . 'categories/single/'.$slug;
      $config['total_rows'] = $this->db->count_all('posts');
      $config['per_page'] = 3;
      $config['uri_segment'] = 4;
      // Init
      $this->pagination->initialize($config);
      
      $data = [
        'title' => 'Posts',
        'posts' =>  $this->Category_model->get_posts_by_slug($slug, $config['per_page'] , $offset)
      ];
        
      if ($data['posts']) {
        $this->load_pages('posts', 'index' , $data); 
      }else{
        $this->session->set_flashdata('no_posts' , 'No posts for this category');
        $this->load_pages('posts', 'index' , $data); 
      }
    }
    
    public function create(){
      // Check login
  		if (! $this->session->userdata('logged_in')) {
  			show_404();
  		}
      
      $data['title'] = 'Create Category';
      
      $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|xss_clean');
      
      if ($this->form_validation->run() == FALSE) {
        $this->load_pages('categories', 'create' , $data);
      } else {
      
        $cats = [
          'cat_name' => html_escape($this->input->post('name')),
          'cat_slug' => url_title(html_escape($this->input->post('name')))
        ];
      
        // Insert
        $is_inserted = $this->Category_model->create_category($cats);
        
        if ($is_inserted) {
          $this->session->set_flashdata('cat_success', 'New category added successfully');
          redirect('categories');
        } else {
          $this->session->set_flashdata('cat_fail', 'Sorry, new category can not be created, try again');
          redirect('categories');
        }
      }
      
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  }