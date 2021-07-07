<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('income/income_m');
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
		if($this->session->userdata('incomeNotFound'))
		{
			$this->session->unset_userdata('incomeNotFound');
		}
		$data['all_income'] = $this->income_m->getAllIncome();
		// var_dump($data['all_income']); die;
		$this->load->view('header/common/top_header_v.php');
		$this->load->view('income/income_v.php',$data);
	}
	public function getfilters()
	{
		$this->load->view('header/common/top_header_v.php');
		if($this->input->post('filter_flag') == '1')
		{
			$fromDate = $this->input->post('fDate');
			$toDate = $this->input->post('tDate');

		$income_data = $this->db->query("SELECT date,description,amount FROM income WHERE date between '$fromDate' AND '$toDate' AND is_deleted='0'");
		if (empty($income_data->result_array())) 
		{
			$data['all_income'] = $this->income_m->getAllIncome();
			$this->session->set_flashdata('incomeNotFound','Income Not Found For This Date');
			$this->load->view('income/income_v.php',$data);
		}else{
			// $this->session->set_flashdata('expsucess','Expense Report Generated Sucessfully');
		// $data['all_expense'] = $this->expense_m->getAllExpense();
		$file_name = 'Income_Report_'.date('Ymd').'.csv';

		 header("Content-Description: File Transfer"); 
	     header("Content-Disposition: attachment; filename=$file_name"); 
	     header("Content-Type: application/csv;");

	    $file = fopen('php://output', 'w');

	    $header = array("Date","Description","Amount"); 
    	fputcsv($file, $header);
    	foreach ($income_data->result_array() as $value) 
    	{
    		fputcsv($file, $value); 
    	}
    	
    	 fclose($file);
    	 exit; 
    	 // readfile($file_name); 
    	 // $this->load->view('expense/expense_v.php',$data);
     	}
		}else{
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if($this->session->userdata('incomeNotFound'))
			{
				$this->session->unset_userdata('incomeNotFound');
			}
			$fromDate = $this->input->post('fDate');
			$toDate = $this->input->post('tDate');
			$filter_data = $this->db->query("SELECT * FROM income WHERE date between '$fromDate' and '$toDate' AND is_deleted='0'");
			$data['filter_data'] = $filter_data->result_array();
			$this->load->view('income/income_v.php',$data);
		}
		}
	}
	public function add_income()
	{
			$this->load->view('header/common/top_header_v.php');
			$this->form_validation->set_rules('incomedate','Income Date','trim|required');
			//$this->form_validation->set_rules('incomedescription','Income Description','trim|required');
			$this->form_validation->set_rules('incomeamount','Income Amount','required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('income/add_income_v.php');
			}else
			{
				$formArray = array();
				$formArray['date'] = $this->input->post('incomedate');
				$formArray['description'] = $this->input->post('incomedescription');
				$formArray['amount'] = $this->input->post('incomeamount');
				$this->income_m->insert_add_income($formArray);
				redirect(base_url().'index.php/income/income/');
			}
	}
	public function edit_add_income($income_id)
	{
		$data['get_income'] = $this->income_m->getIncomeByIncomeId($income_id);
		// var_dump($data['get_income']); die;
			$this->load->view('header/common/top_header_v.php');
			$this->form_validation->set_rules('incomedate','Income Date','trim|required');
			//$this->form_validation->set_rules('incomedescription','Income Description','trim|required');
			$this->form_validation->set_rules('incomeamount','Income Amount','required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('income/edit_income_v.php',$data);
			}else
			{
				$formArray = array();
				$formArray['date'] = $this->input->post('incomedate');
				$formArray['description'] = $this->input->post('incomedescription');
				$formArray['amount'] = $this->input->post('incomeamount');
				$this->income_m->update_add_income($income_id,$formArray);
				redirect(base_url().'index.php/income/income/');
			}
	}
	public function delete_income($income_id)
	{
		$this->income_m->delete_income($income_id);
		redirect(base_url().'index.php/income/income');
	}
}