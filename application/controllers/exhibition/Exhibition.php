<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Exhibition extends CI_Controller
{
	public $lastInsertID = '';
	function __construct()
	{
		parent::__construct();
		$this->load->model('exhibition/exhibition_m');
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
		$data1['fetch_records'] = $this->exhibition_m->getAllExhibition();
		// $data['fetch_records'] = '';
		$this->load->view('header/common/top_header_v.php');
		$this->load->view('exhibition/exhibition_v.php',$data1);
	}
	public function newExhibition()
	{
		$this->load->view('header/common/top_header_v.php');
		
			$this->form_validation->set_rules('totalcounter','Total Counter','trim|required|numeric');
			$this->form_validation->set_rules('startdate','Start Date','required');
			$this->form_validation->set_rules('enddate','End Date','required');
			// $this->form_validation->set_rules('comr','Commission Received','trim|numeric|required');
			// $this->form_validation->set_rules('comb','>Comission Balance','required');
			// $this->form_validation->set_rules('totcom','Total Comission','required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('exhibition/create_v.php');
			}else
			{
				$formArray = array();
				$formArray['total_stands'] = $this->input->post('totalcounter');
				$formArray['start_date'] = $this->input->post('startdate');
				$formArray['end_date'] = $this->input->post('enddate');
				$formArray['commission_received'] = $this->input->post('comr');
				$formArray['comission_balance'] = $this->input->post('comb');
				$formArray['total_comission'] = $this->input->post('totcom');
				$this->exhibition_m->create($formArray);
				redirect(base_url().'index.php/exhibition/exhibition/');
			}
	}
	public function newStand($exhibition_Id)
	{
		$user = $this->exhibition_m->getExhibition($exhibition_Id);
		$partyDropdown = $this->exhibition_m->getAllPartyDropDown();
		// $AllBackbalance = $this->exhibition_m->getAllBackBalanceDESC(1);
		// var_dump($AllBackbalance); die;	
		$data = array();
		$data['users'] = $user;
		$data['partyDropdown'] = $partyDropdown;
		$data['title'] = 'Add New Stand';
		$this->load->view('header/common/top_header_v.php');
		// $this->load->view('exhibition/addStand_v.php',$data);
			$this->form_validation->set_rules('counterno','Counter Number','trim|required|numeric');
			$this->form_validation->set_rules('partyname','Party Name','required');
			$this->form_validation->set_rules('totalearning','Total Earning','required|numeric');
			$this->form_validation->set_rules('comissionpaid','Comission Paid','required|numeric');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('exhibition/addStand_v.php',$data);
			}else
			{
				$p_id = $this->input->post('partyname');
			// var_dump($this->input->post('partyname')) ; die;

			//get backbal by party id
			$partyBackBalance = $this->exhibition_m->getBackBalance($p_id);
			// var_dump($partyBackBalance); die;

			$formArray = array();
			$formArray['exhibition_id'] = $exhibition_Id;
			$formArray['stand_no'] = $this->input->post('counterno');
			$formArray['party_id'] = $this->input->post('partyname');
			$formArray['total_earning'] = $this->input->post('totalearning');
			$formArray['comission_paid'] = $this->input->post('comissionpaid');
			$formArray['comission_balance'] = $this->input->post('comissionbalance');
			$formArray['total_comission'] = $this->input->post('totalcomission');
			if ($partyBackBalance) 
			{
				// $formArray['back_balance'] = $partyBackBalance['back_balance'] + $partyBackBalance['comission_balance'];
				$formArray['back_balance'] = $partyBackBalance;
			}else{

				$formArray['back_balance'] = $this->input->post('backbalance');
			}
			$formArray['reference'] = $this->input->post('reference');
			$formArray['extra'] = $this->input->post('extra');
			$this->exhibition_m->addStand($formArray);
			redirect(base_url().'index.php/exhibition/exhibition/edit/'.$exhibition_Id);	
			}
	}
	public function editStand($exhibition_Id = null,$stand_id = null,$sms_flag=null)
	{
		// $getflagforincome = $this->exhibition_m->returnIncomeifexist($stand_id);
		// $data['getflagforincome'] = $getflagforincome;
		// var_dump($data['getflagforincome']); die;
		// 0 = false 
		$allincome = $this->exhibition_m->getAllIncome($stand_id);
		$exhibition_id = $this->exhibition_m->getExhibition($exhibition_Id);
		$stand_info = $this->exhibition_m->getStand($stand_id);
		$partyDropdown = $this->exhibition_m->getAllPartyDropDown($stand_id);
		// $partyDropdown = $this->exhibition_m->getPartySelected($exhibition_Id,$stand_id);
		$totalSumIncome = $this->exhibition_m->getTotalIncomeByStandid($stand_id);
		// var_dump($totalSumIncome); die;
		$data = array();
		$data['exhibition_id'] = $exhibition_id;
		// var_dump($user); die;
		$data['users'] = $stand_info;
		$data['partyDropdown'] = $partyDropdown;
		$data['allincome'] = $allincome;
		$data['totalSumIncome'] = $totalSumIncome['total'];
		$data['title'] = 'Edit Stand';
			$this->load->view('header/common/top_header_v.php');
			$this->form_validation->set_rules('counterno','Counter Number','trim|required');
			// $this->form_validation->set_rules('partyname','Party Name','required');
			// $this->form_validation->set_rules('totern','Total Earning','required|numeric');
			$this->form_validation->set_rules('comissionpaid','Comission Paid','numeric');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('exhibition/editStand_v.php',$data);
			}else
			{
				$formArray = array();
				// $formArray['exhibition_id'] = $exhibition_Id;
				$formArray['stand_no'] = $this->input->post('counterno');
				$formArray['party_id'] = $this->input->post('partyname');
				$formArray['total_earning'] = $this->input->post('totalearning');
				$formArray['comission_paid'] = $this->input->post('comissionpaid');
				$formArray['comission_balance'] = $this->input->post('comissionbalance');
				$formArray['total_comission'] = $this->input->post('totalcomission');
				$formArray['back_balance'] = $this->input->post('backbalance');
				$formArray['reference'] = $this->input->post('reference');
				$formArray['extra'] = $this->input->post('extra');
				$this->exhibition_m->updateStand($stand_id,$formArray);
				$this->exhibition_m->updateExhibitionColumn($exhibition_Id,$stand_id,$formArray);
				$this->exhibition_m->updateBackBalance($formArray['party_id'],$formArray['comission_balance']);
//----------------------------------------------------------------------------------------------------------------------------------
		if($this->input->post('smsflag')==1)
		{
			// SMS Code Starts
		
		$lastbackbalance = $this->exhibition_m->getStandBackBalance($stand_id);
		$data['getStandComissionPaid'] = $this->exhibition_m->getStandComissionPaid($stand_id);
		$data['getStandComissionBalance'] = $this->exhibition_m->getStandComissionBalance($stand_id);
		$data['getStandBackBalance'] = $this->exhibition_m->getStandBackBalance($stand_id);
		$data['getStandExtra'] = $this->exhibition_m->getStandExtra($stand_id);
		$partyNumer = $this->exhibition_m->getPartyNumberByPartyId($this->input->post('partyid'));
		
			$income_str ="";
			foreach ($allincome as $single_income) 
			{
				$income_str .= date("d-m-Y", strtotime($single_income['date'])).' - '.$single_income['income'].' ';
			}
				$message = " From Stall Management.  ".$income_str."  "."Back Balance - ".$data['getStandBackBalance']."  "."Extra Paid - ".$data['getStandExtra']."  "."Comission Paid - ".$data['getStandComissionPaid']."  "."Comission Balance - ".$data['getStandComissionBalance'];
					
			if (!empty($allincome)) 
			{
					// $url='http://www.bulksmsapps.com/api/apismsv2.aspx?apikey=''&sender=''&number=91'.$partyNumer.'&message='.urlencode($message);
					// $ch = curl_init($url);
					// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// $result = curl_exec($ch);
					// var_dump($result); die;
					$this->session->set_flashdata('sent','Message Sent Sucessfull');
					redirect(base_url().'index.php/exhibition/exhibition/editStand/'.$exhibition_Id.'/'.$stand_id);
			}else{
				$this->session->set_flashdata('fail','Message Not Sent Without Income');
				redirect(base_url().'index.php/exhibition/exhibition/editStand/'.$exhibition_Id.'/'.$stand_id);
			}
		
		// sms code ends 
		}
														//SMS CODE ENDS HERE
		//----------------------------------------------------------------------------------------------------------------------------------
				redirect(base_url().'index.php/exhibition/exhibition/edit/'.$exhibition_Id);
			}
	}
	public function addIncome($exhibition_Id = null,$stand_id,$party_id)
	{
		$data['exhibition_Id'] = $exhibition_Id;
		$data['stand_id'] = $stand_id;
		$data['party_id'] = $party_id;
		$this->load->view('header/common/top_header_v.php');
		$this->form_validation->set_rules('incomeDate','Income Date','trim|required');
		$this->form_validation->set_rules('income','Income','trim|required');
		$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
		if($this->form_validation->run() == FALSE )
		{
			$this->load->view('exhibition/addIncome_v.php',$data);
		}else
		{
			$formArray = array();
			$formArray['exhibition_id'] = $exhibition_Id;
			$formArray['stand_id'] = $stand_id;
			$formArray['party_id'] = $party_id;
			$formArray['date'] = $this->input->post('incomeDate');
			$formArray['income'] = $this->input->post('income');
			$this->exhibition_m->addIncome($formArray);     //--> insert into db income tbl
			// Get All Total Of Income return type Array With pre calculated from model
			$totalSumIncome = $this->exhibition_m->getTotalIncomeByStandid($stand_id);
			// Update Columns Code

			$lastbackbalance = $this->exhibition_m->getStandBackBalance($stand_id);
			// var_dump($lastbackbalance); die;
			$this->exhibition_m->updateTotalEarning($exhibition_Id,$stand_id,$totalSumIncome['totalEarning']);
			$this->exhibition_m->updateComissionBalance($exhibition_Id,$stand_id,$totalSumIncome['commissionBalance'],$lastbackbalance);
			$this->exhibition_m->updateTotalComission($exhibition_Id,$stand_id,$totalSumIncome['totalComission'],$lastbackbalance);
			redirect(base_url().'index.php/exhibition/exhibition/editStand/'.$exhibition_Id.'/'.$stand_id);
		}
	}
	public function editaddIncome($exhibition_Id = null,$stand_id,$income_id = null)
	{
		// var_dump($income_id); die;
		$data['getincomedata'] = $this->exhibition_m->getincomedata($exhibition_Id,$stand_id,$income_id);
		// var_dump($data['getincomedata']); die;
		$data['exhibition_Id'] = $exhibition_Id;
		$data['stand_id'] = $stand_id;
		$this->load->view('header/common/top_header_v.php');
		$this->form_validation->set_rules('incomeDate','Income Date','trim|required');
		$this->form_validation->set_rules('income','Income','trim|required');
		$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
		if($this->form_validation->run() == FALSE )
		{
			$this->load->view('exhibition/editaddincome_v.php',$data);
		}else
		{
			$formArray = array();
			$formArray['exhibition_id'] = $exhibition_Id;
			$formArray['stand_id'] = $stand_id;
			$formArray['date'] = $this->input->post('incomeDate');
			$formArray['income'] = $this->input->post('income');
			// var_dump($formArray);
			$this->exhibition_m->updateincomedata($exhibition_Id,$stand_id,$formArray,$income_id);
			// Get All Total Of Income return type Array With pre calculated from model
			$totalSumIncome = $this->exhibition_m->getTotalIncomeByStandid($stand_id);
			// Update Columns Code
			$lastbackbalance = $this->exhibition_m->getStandBackBalance($stand_id);
			$this->exhibition_m->updateTotalEarning($exhibition_Id,$stand_id,$totalSumIncome['totalEarning']);
			$this->exhibition_m->updateComissionBalance($exhibition_Id,$stand_id,$totalSumIncome['commissionBalance'],$lastbackbalance);
			$this->exhibition_m->updateTotalComission($exhibition_Id,$stand_id,$totalSumIncome['totalComission'],$lastbackbalance);
			redirect(base_url().'index.php/exhibition/exhibition/editStand/'.$exhibition_Id.'/'.$stand_id);
		}
	}
	public function edit($exhibition_Id)
	{
		$user = $this->exhibition_m->getExhibition($exhibition_Id);
		$getAllStands = $this->exhibition_m->getAllStand($exhibition_Id);
		$data = array();
		$data['users'] = $user;
		$data['getAllStands'] = $getAllStands;
		$data['title'] = 'Edit';
		$this->load->view('header/common/top_header_v.php');
		// $this->load->view('exhibition/edit_v.php',$data);
			$this->form_validation->set_rules('totalcounter','Total Counter','trim|required|integer');
			$this->form_validation->set_rules('startdate','Start Date','required');
			$this->form_validation->set_rules('enddate','End Date','required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('exhibition/edit_v.php',$data);
			}else
			{
				$formArray = array();
				$formArray['total_stands'] = $this->input->post('totalcounter');
				$formArray['start_date'] = $this->input->post('startdate');
				$formArray['end_date'] = $this->input->post('enddate');
				$formArray['commission_received'] = $this->input->post('comr');
				$formArray['comission_balance'] = $this->input->post('comb');
				$formArray['total_comission'] = $this->input->post('totcom');
				$this->exhibition_m->update($exhibition_Id,$formArray);
				redirect(base_url().'index.php/exhibition/exhibition/');
			}
	}
	public function deleteExhibition($exhibition_Id)
	{
		$delRes = $this->exhibition_m->deleteExhibition($exhibition_Id);
		// var_dump($user); die;
		if(empty($delRes))
		{
			// $this->session->set_flashdata('Failed','Record Not Found');
			redirect(base_url().'index.php/exhibition/exhibition/');	
		}
		// $this->session->set_flashdata('success','Record Deleted');
		redirect(base_url().'index.php/exhibition/exhibition/');	
	}
	public function deleteStand($exhibition_Id,$stand_id)
	{
		$delRes = $this->exhibition_m->deleteStand($stand_id);
		$this->exhibition_m->updateExhibitionColumn($exhibition_Id,$stand_id);
		// var_dump($user); die;
		if(empty($delRes))
		{
			// $this->session->set_flashdata('Failed','Record Not Found');
			redirect(base_url().'index.php/exhibition/exhibition/edit/'.$exhibition_Id);	
		}
		// $this->session->set_flashdata('success','Record Deleted');
		redirect(base_url().'index.php/exhibition/exhibition/edit/'.$exhibition_Id);	
	}
	public function deleteincome($exhibition_Id,$stand_id,$income_id)
	{
		$this->exhibition_m->deleteincome($stand_id,$income_id);
		// Get All Total Of Income return type Array With pre calculated from model
			$totalSumIncome = $this->exhibition_m->getTotalIncomeByStandid($stand_id);
			// Update Columns Code
			$this->exhibition_m->updateTotalEarning($exhibition_Id,$stand_id,$totalSumIncome['totalEarning']);
			$this->exhibition_m->updateComissionBalance($exhibition_Id,$stand_id,$totalSumIncome['commissionBalance']);
			$this->exhibition_m->updateTotalComission($exhibition_Id,$stand_id,$totalSumIncome['totalComission']);
			redirect(base_url().'index.php/exhibition/exhibition/editStand/'.$exhibition_Id.'/'.$stand_id);
	}
	public function ajaxCode()
	{
		$p_id = $_POST['partyid'];
		// print_r($p_id);
		$AllBackbalance = $this->exhibition_m->getBackBalance($p_id);
		echo $AllBackbalance;
	}
	public function getflagForUpdateExhibitioncol()
	{
		$flag = $_POST['partyid'];
		echo $flag;
		// return $flag;
	}
	public function ajaxupdatetotcandcomb()
	{
		$flag = $_POST['partyid'];
		echo $flag;
	}
}