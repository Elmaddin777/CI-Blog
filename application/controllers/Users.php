<?php

	class Users extends CI_Controller {

		public function register(){
			$data['title'] = 'Sign up';
			
			$this->form_validation->set_rules('fullname', 'Fullname', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_username_exists[$username]|min_length[3]|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.user_email]|valid_email|xss_clean');
			$this->form_validation->set_rules('zip', 'Zip', 'xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('password_2', 'Confirmation Password', 'required|matches[password]|xss_clean');
			
			$this->form_validation->set_message('matches', 'Passwords do not match!');
			$this->form_validation->set_message('is_unique', 'Sorry, the entered email is already taken');
			$this->form_validation->set_message('username_exists', 'Sorry, the entered username is already taken');
				
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('register_errors', validation_errors());
				$this->load_pages('users', 'create', $data);
			} else {
				// Collect user input
				$data = [
					'user_fullname' => html_escape($this->input->post('fullname')),
					'user_zipcode'  => html_escape($this->input->post('zip')),
					'user_email'    => html_escape($this->input->post('email')),
					'user_name'     => html_escape($this->input->post('username')),
					'user_password' => html_escape($this->input->post('password'))
				];
				
				// Encrypt password
				$data['user_password'] = password_hash($data['user_password'] , PASSWORD_BCRYPT);
				
				$is_inserted = $this->User_model->create_user($data);
				
				if ($is_inserted) {
						$this->session->set_flashdata('register_success', 'You registered successfully, please login');
						redirect('users/login');
				} else {
						$this->session->set_flashdata('register_fail', 'Your registration is unsuccessfull, try again');
						redirect('users/register');
				}		
				
			}
			
		}
		
		public function login(){
			
			$data['title'] = 'Sign in';
	
			$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
			if ($this->form_validation->run() == FALSE) {
				$this->load_pages('users', 'login', $data);
			} else {
				// Collect user input
				$data = [
					'email'    => html_escape($this->input->post('email')),
					'password' => html_escape($this->input->post('password'))
				];
				
				// Encrypt password
				$data['user_password'] = password_hash($data['password'] , PASSWORD_BCRYPT);
				// Login 
				$user_id = $this->User_model->login($data);
				
				// Login return user id
				if ($user_id) {
					$user_data = [
						'user_id' => $user_id,
						'user_email' => $data['email'],
						'logged_in' => TRUE 
					];
					
					// Set session
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('login_success', 'You are logged in');
					redirect('posts');
				} else {
						$this->session->set_flashdata('login_fail', 'Invalid login, try again');
						redirect('users/login');
				}		
				
			}
			
			
			
		}
		
		public function logout(){
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_email');
			redirect();
		}
		

		public function username_exists($username){
			$check = $this->User_model->check_username_exists($username);
			return $check ? false : true;
		}
		
		
		
	
	}