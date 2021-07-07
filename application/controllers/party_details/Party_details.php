<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Party_details extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('party_details/party_details_m'));
		$this->logged_in();
	}
	public function logged_in()
	{
		if(!$this->session->userdata('authenticated')){
			redirect('login');
		}
	}
	public function index()
	{
		$data['fetch_records'] = $this->party_details_m->getAllRecords();
		$this->load->view('header/common/top_header_v.php');
		$this->load->view('party_details/party_details_v.php',$data);
	}
	public function create()
	{
		$this->load->view('header/common/top_header_v.php');
		// $this->load->view('party_details/create_v');
			$this->form_validation->set_rules('partyName','Name','trim|required');
			$this->form_validation->set_rules('phoneNo','Mobile No','integer|required');
			$this->form_validation->set_rules('email','Email','valid_email|required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('party_details/create_v');
		}else
		{
			$formArray = array();
			$formArray['name'] = $this->input->post('partyName');
			$formArray['mobile_no'] = $this->input->post('phoneNo');
			$formArray['email']   = $this->input->post('email');
			$formArray['back_balance'] = $this->input->post('backBalance');
			$this->party_details_m->create($formArray);
			$this->session->set_flashdata('success','Record Added');
			redirect(base_url().'index.php/party_details/party_details/index');
		}	
		// if($_SERVER["REQUEST_METHOD"] == "POST")
		// {
		// 	// $this->form_validation->set_rules('backBalance','Back','required');
		// 	// $res = $this->form_validation->run();
		// 	// var_dump($res); die;	
		// }
	}
	public function edit($user_Id)
	{
		$user = $this->party_details_m->getUser($user_Id);
		$data = array();
		$data['users'] = $user;
		$this->load->view('header/common/top_header_v.php');
		// $this->load->view('party_details/edit',$data);
		$this->form_validation->set_rules('partyName','Name','trim|required');
			$this->form_validation->set_rules('phoneNo','Mobile No','integer|required');
			$this->form_validation->set_rules('email','Email','valid_email|required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('party_details/edit',$data);
		}else
		{
			$formArray = array();
			$formArray['name'] = $this->input->post('partyName');
			$formArray['mobile_no'] = $this->input->post('phoneNo');
			$formArray['email']   = $this->input->post('email');
			$formArray['back_balance'] = $this->input->post('backBalance');
			$this->party_details_m->updateUser($user_Id,$formArray);
			$this->session->set_flashdata('success','Record Added');
			redirect(base_url().'index.php/party_details/party_details/index');	
		}	
		// $this->form_validation->set_rules('fname','Name','trim|required|alpha');
		// $this->form_validation->set_rules('mnumber','Mobile No','required');
		// $this->form_validation->set_rules('email','Email','required');
		// $this->form_validation->set_rules('backbalance','Back','required');
		// $this->form_validation->run();
			// var_dump('expression'); die;
		// if($_SERVER["REQUEST_METHOD"] == "POST")
		// {
		// 	$formArray = array();
		// 	$formArray['name'] = $this->input->post('partyName');
		// 	$formArray['mobile_no'] = $this->input->post('phoneNo');
		// 	$formArray['email']   = $this->input->post('email');
		// 	$formArray['back_balance'] = $this->input->post('backBalance');
		// 	$this->party_details_m->updateUser($user_Id,$formArray);
		// 	$this->session->set_flashdata('success','Record Added');
		// 	redirect(base_url().'index.php/party_details/party_details/index');	
		// }
	}
	public function delete($user_Id)
	{
		$user = $this->party_details_m->getUser($user_Id);
		if(empty($user))
		{
			$this->session->set_flashdata('Failed','Record Not Found');
			redirect(base_url().'index.php/party_details/party_details/index');	
		}
		$this->party_details_m->deleteUser($user_Id);
		$this->session->set_flashdata('success','Record Deleted');
		redirect(base_url().'index.php/party_details/party_details/index');	
	}
	public function logout()
		{
			// var_dump('expression'); die;
			$this->session->sess_destroy();
			redirect('login/login');
		}
}

?>