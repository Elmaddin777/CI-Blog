<?php 
  class Post_model extends CI_Model
  {
      private $table = 'posts';    
    
      public function get_posts($slug = FALSE , $limit = FALSE , $offset = FALSE){
        // With limit 
        if ($limit) {
          $query = $this->db
                        ->join('categories', 'categories.cat_id = posts.category_id')
                        ->order_by('posts.created_at', 'DESC')
                        ->get('posts', $limit, $offset);
        
          //print_r($query->result()); die();              
        
          return $query->result();
        }
        
        // No parameter
        if (! $slug) {
          $query =  $this->db
                         ->join('categories', 'categories.cat_id = posts.category_id')
                         ->order_by('posts.created_at', 'DESC')
                         ->get('posts');
        
          return $query->result();
        }
      
        // With parameter must be where cond.
        $query = $this->db
                      ->join('categories', 'categories.cat_id = posts.category_id')
                      ->where('posts.slug', $slug)
                      ->get('posts');
      
        return $query->row();
        
      }
      
    
      public function find_post($slug){
        $result = $this->db
                       ->join('categories', 'categories.cat_id = posts.category_id')
                       ->where('slug', $slug)
                       ->get('posts')
                       ->row();
        if ($result){
          return $result;
        } else {
          return FALSE;
        }
      }
      
      public function find_post_by_id($id){
        $result = $this->db
                       ->join('categories', 'categories.cat_id = posts.category_id')
                       ->where('id', $id)
                       ->get('posts')
                       ->row();
        if ($result){
          return $result;
        } else {
          return FALSE;
        }
      }
      
      public function create_post($data){
        $this->db->insert('posts', $data);
        return $this->db->affected_rows() != 1 ? false : true;
      }
      
      public function update_post($id, $data){
        // Find the post
        $post = $this->find_post_by_id($id);
        // Must unset image first
        if ($post->img != 'noimage.jpg') {
          unlink('./assets/img/'.$post->img);
        }
        
        $this->db->update($this->table, $data, array('id' => $id));
        return $this->db->affected_rows() != 1 ? false : true;
      }
      
      public function delete_post($id){
        // Find the post
        $post = $this->find_post_by_id($id);
        // Must unset image first
        if ($post->img != 'noimage.jpg') {
          unlink('./assets/img/'.$post->img);
        }
      
        $this->db->delete('posts', array('id' => $id));
        return $this->db->affected_rows() != 1 ? false : true;
      }
  
      /* 
      * Categories
      */
      
      public function get_categories(){
        $query = $this->db->order_by('created_at', 'DESC')->get('categories');
        return $query->result();
      }










  }
  