<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Expense extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('expense/expense_m');
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
		if($this->session->userdata('expNotFound'))
		{
			$this->session->unset_userdata('expNotFound');
		}
		$data['all_expense'] = $this->expense_m->getAllExpense();
		$this->load->view('header/common/top_header_v.php');
		$this->load->view('expense/expense_v.php',$data);
	}
	// public function expo
	public function getfilters()
	{
		$this->load->view('header/common/top_header_v.php');
		if($this->input->post('filter_flag') == '1')
		{
			$fromDate = $this->input->post('fDate');
			$toDate = $this->input->post('tDate');

		$expense_data = $this->db->query("SELECT expense_date,description,expense_amount FROM expense WHERE expense_date between '$fromDate' AND '$toDate' AND is_deleted='0'");
		if (empty($expense_data->result_array())) 
		{
			$data['all_expense'] = $this->expense_m->getAllExpense();
			$this->session->set_flashdata('expNotFound','Expense Not Found For This Date');
			// $this->load->view('expense/expense_v.php',$data);
			// redirect('/login/form/', 'refresh');
			$this->load->view('expense/expense_v.php',$data);
			
		}else{
			// $this->session->set_flashdata('expsucess','Expense Report Generated Sucessfully');
			$data['all_expense'] = $this->expense_m->getAllExpense();
		$file_name = 'Expense_Report_'.date('Ymd').'.csv';

		 header("Content-Description: File Transfer"); 
	     header("Content-Disposition: attachment; filename=$file_name"); 
	     header("Content-Type: application/csv;");

	    $file = fopen('php://output', 'w');

	    $header = array("Expense Date","Description","Expense Amount"); 
    	fputcsv($file, $header);
    	foreach ($expense_data->result_array() as $value) 
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
			if($this->session->userdata('expNotFound'))
			{
				$this->session->unset_userdata('expNotFound');
			}
			$fromDate = $this->input->post('fDate');
			$toDate = $this->input->post('tDate');
			$filter_data = $this->db->query("SELECT * FROM expense WHERE expense_date between '$fromDate' and '$toDate' AND is_deleted='0'");
			$data['filter_data'] = $filter_data->result_array();
			$this->load->view('expense/expense_v.php',$data);
		}
		}
	}
	public function add_expense()
	{
		$this->load->view('header/common/top_header_v.php');
			$this->form_validation->set_rules('expensedate','Income Date','trim|required');
			$this->form_validation->set_rules('expensedescription','Expense Description','required');
			$this->form_validation->set_rules('expenseamount','Expense Amount','required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('expense/add_expense_v.php');
			}else
			{
				$formArray = array();
				$formArray['expense_date'] = $this->input->post('expensedate');
				$formArray['description'] = $this->input->post('expensedescription');
				$formArray['expense_amount'] = $this->input->post('expenseamount');
				$this->expense_m->insert_add_expense($formArray);
				redirect(base_url().'index.php/expense/expense');
			}
	}
	public function edit_expense($expense_id)
	{
		$data['get_expense'] = $this->expense_m->getExpenseById($expense_id);
		$this->load->view('header/common/top_header_v.php');
			$this->form_validation->set_rules('expensedate','Income Date','trim|required');
			$this->form_validation->set_rules('expensedescription','Expense Description','required');
			$this->form_validation->set_rules('expenseamount','Expense Amount','required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('expense/edit_expense_v.php',$data);
			}else
			{
				$formArray = array();
				$formArray['expense_date'] = $this->input->post('expensedate');
				$formArray['description'] = $this->input->post('expensedescription');
				$formArray['expense_amount'] = $this->input->post('expenseamount');
				$this->expense_m->update_add_expense($expense_id,$formArray);
				redirect(base_url().'index.php/expense/expense');
			}
	}
	public function delete_expense($expense_id)
	{
		$this->expense_m->delete_expense($expense_id);
		redirect(base_url().'index.php/expense/expense');
	}
}