<?php 
  class Comment_model extends CI_Model {
    
    public function create_comment($data){
      $this->db->insert('comments', $data);
      return $this->db->affected_rows() != 1 ? false : true;
    }
    
    public function get_comments($post_id){
      $query = $this->db
                    ->join('posts', 'posts.id = comments.post_id' )
                    ->where('post_id', $post_id)
                    ->order_by('comments.created_at', 'DESC')
                    ->get('comments');
    
      return $query->result();
    }


  }