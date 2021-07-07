<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class Login extends CI_Controller
	{	
		public function index()
		{
			$this->load->helper(array('form', 'url'));
			 $this->load->library('form_validation');
			 if($this->session->userdata('authenticated')){
			redirect(base_url().'index.php/party_details/party_details/index');
			}
			$this->load->view('login/login_v');
		}
		public function loginchk()
		{
			$this->load->model('login/login_m');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('usr', 'Username', 'trim|required|alpha');
	        $this->form_validation->set_rules('pswd', 'Password', 'trim|required|alpha_numeric|min_length[4]');
	                if ($this->form_validation->run() == FALSE)
	                {
	                        $this->load->view('login/login_v');
	                }
	                else
	                {
	                       // $this->load->model('login/login_m');
			$user = $passwd = "";
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$user = $this->input->post('usr');
				$passwd = $this->input->post('pswd');
				$status = $this->login_m->login_valid($user,$passwd);
			}
			if($status)
			{
				// echo "Login Sucessfull";
				// var_dump($status->id); die;
				if ($status) {
					$userdataa = array(
						'id' =>$status->id,
						'name' =>$status->firstname,
						'authenticated'=> TRUE
					);
					$this->session->set_userdata($userdataa);
				}
				$this->session->set_flashdata('sucess','Login Sucessfull');
				// $this->load->view('login/login_v');
				redirect(base_url().'index.php/party_details/party_details');
			}else{
				$this->session->set_flashdata('failed','Login Failed Check Your Username And Password');
				$this->load->view('login/login_v');
			}
	       }	
		}
	}
	?>