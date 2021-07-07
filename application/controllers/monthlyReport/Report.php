<?php
defined('BASEPATH') OR 	exit('No direct script access allowed');
/**
 * 
 */
class Report extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct(); //very imp 
		$this->load->model('exhibition/exhibition_m');
		$this->load->model('monthlyReport/report_m');
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
		$data['partyDropdown'] = $this->exhibition_m->getAllPartyDropDown();
		$this->load->view('header/common/top_header_v.php');
		$this->load->view('monthlyReport/monthlyReport_v.php',$data);
	}
	public function getReportFields()
	{
		$data['partyDropdown'] = $this->exhibition_m->getAllPartyDropDown();

		$this->load->view('header/common/top_header_v.php');
			$this->form_validation->set_rules('partyName','Party Name','trim|required');
			$this->form_validation->set_rules('fromDate','From Date','required');
			$this->form_validation->set_rules('toDate','To Date','required');
			$this->form_validation->set_error_delimiters('<div class="add_edit_error">*','*</div>');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('monthlyReport/monthlyReport_v.php',$data);	
			}else
			{

				
						// $emptyDate = $this->input->post('emptyDate'); //party id
						$partyId = $this->input->post('partyName'); //party id
						$fromDate = $this->input->post('fromDate');
						$toDate = $this->input->post('toDate');
						$stand_id = $this->report_m->getStandIdByPartyId($partyId);
						if($stand_id == 0)
						{
							$this->session->set_flashdata('partynotFound','Record Not Found Party');
							$this->load->view('monthlyReport/monthlyReport_v.php',$data);
							// var_dump($stand_id); die;
						}else{
							$getIncomeRecport=$this->report_m->getIncomeReport($partyId,$stand_id,$fromDate,$toDate);
							if ($getIncomeRecport == 0) {
								$this->session->set_flashdata('incomenotFound','Income Not Found For Selected Party');
								$this->load->view('monthlyReport/monthlyReport_v.php',$data);
							}else
							{
								$this->export_to_CSV($partyId,$stand_id,$fromDate,$toDate);
							}
						}
						
						//from Date	
						// $nfDate = date_create($fromDate);
						// $fromDate_formated_full = date_format($nfDate,"d/m/Y");
						// $fromDate_formated_day = date_format($nfDate,"d");
						// $fromDate_formated_month = date_format($nfDate,"m");
						// $data['fromDate_formated_full']  	= $fromDate_formated_full;
						// $data['fromDate_formated_day']  	= $fromDate_formated_day;
						// $data['fromDate_formated_month'] 	= $fromDate_formated_month;
						// //to Date
						// $ntDate = date_create($toDate);
						// $toDate_formated_full = date_format($ntDate,"d/m/Y");
						// $toDate_formated_day = date_format($ntDate,"d");
						// $toDate_formated_month = date_format($ntDate,"m");
						// $data['toDate_formated_full']  	= $toDate_formated_full;
						// $data['toDate_formated_day']  	= $toDate_formated_day;
						// $data['toDate_formated_month'] 	= $toDate_formated_month;
						// $this->load->view('monthlyReport/monthlyReport_v.php',$data);
			}
	}
	public function export_to_CSV($partyId,$stand_id,$fromDate,$toDate)
	{
		$file_name = 'monthlyReport_'.date('Ymd').'.csv';
		 header("Content-Description: File Transfer"); 
	     header("Content-Disposition: attachment; filename=$file_name"); 
	     header("Content-Type: application/csv;");

      // get data 

     $student_data = $this->report_m->getIncomeReport($partyId,$stand_id,$fromDate,$toDate);
     $backBalance = $this->exhibition_m->getBackBalance($partyId);
     $party_Name = $this->report_m->getPartyName($partyId);
     $party_Number = $this->report_m->getPartyNumber($partyId);
     $party_referance = $this->report_m->getLatestRef($partyId);
     $party_Extra = $this->report_m->getExtraTotal($partyId);
     $total_com_paid = $this->report_m->getTotalComPaid($partyId);
     $total_counters = $this->report_m->getTotalCOunters($partyId);
     // var_dump($party_Name); die;

     // file creation 
     $file = fopen('php://output', 'w');

    $header = array("Counter No.",$total_counters); 
    fputcsv($file, $header);

    $header = array("Party Name",$party_Name); 
    fputcsv($file, $header);

    $header = array("Reference",$party_referance); 
    fputcsv($file, $header);

    $header = array("Extra",$party_Extra); 
    fputcsv($file, $header);	

    $header = array("Contact No.",$party_Number); 
    fputcsv($file, $header);

    $header = array("Date","Income"); 
    fputcsv($file, $header);
     // $ok = array('pl','ok');
    $intot = 0;
     foreach ($student_data as $value)
     { 
     	$intot += $value['income'];
       fputcsv($file, $value); 
     }
     $tc = $intot * 20/100;
     // $backBalance = $backBalance;
     $arr1 = array('Total Earning',$intot);
     fputcsv($file, $arr1); 
     $arr2 = array('Total Comission',$tc);
     fputcsv($file, $arr2); 
     $arr3 = array('Back Balance',$backBalance);
     fputcsv($file, $arr3);

     // $cnb = $tc+ $backBalance;
     $cnb = $backBalance;
     $arr4 = array('Total Balance',$cnb);
     fputcsv($file, $arr4);
     $arr5 = array('Paid',$total_com_paid);
     fputcsv($file, $arr5);
     fclose($file); 
     exit; 
	}
}
?>