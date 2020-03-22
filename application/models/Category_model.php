<?php 
  class Category_model extends CI_Model {
    public function get_categories($slug = FALSE){
      if (! $slug) {
        $query = $this->db
                      ->order_by('created_at', 'DESC')
                      ->get('categories');
        
        return $query->result();
      } else {
        $query = $this->db
                      ->where('categories.cat_slug', $slug)
                      ->get('categories');
      
        return $query->row();
      }
    }
    
    public function get_posts_by_slug($slug, $limit = FALSE, $offset = FALSE){
      if ($limit) {
        $query = $this->db
                      ->join('posts', 'posts.category_id = categories.cat_id')
                      ->where('categories.cat_slug', $slug)
                      ->get('categories', $limit, $offset);
      } else {
        $query = $this->db
                      ->join('posts', 'posts.category_id = categories.cat_id')
                      ->where('categories.cat_slug', $slug)
                      ->get('categories');
      }

      return $query->result();
    }
    
    public function create_category($data){
      $this->db->insert('categories', $data);
      return $this->db->affected_rows() != 1 ? false : true;
    }
  
  
  
  
  }