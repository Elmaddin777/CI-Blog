<?php 

  class User_model extends CI_Model
  {
    
    public function create_user($data){
        $this->db->insert('users', $data);
        return $this->db->affected_rows() != 1 ? false : true;
    }
    
    public function check_username_exists($username){
      $result = $this->db
                     ->where('user_name', $username)
                     ->get('users');
                     
      if ($result->num_rows() != 0) {
        return true;
      } else {
        return false;
      }
    }
    
    public function login($data){
      $result = $this->db
                     ->where('user_email', $data['email'])
                     ->get('users')
                     ->row();
      
      if (! $result) {
        return false;
      }
    
      if (password_verify($data['password'] , $result->user_password )) {
        return $result->user_id;
      } else {
        return false;
      }
    
    }
  
  
  }
  