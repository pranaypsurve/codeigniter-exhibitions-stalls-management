<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_m extends CI_Model
{
	// function __construct()
	// {
	// 	parent::__construct();
	// }

	public function getStandIdByPartyId($partyId)
	{
		$user = $this->db->query("SELECT * FROM exhibition_stand WHERE party_id='$partyId' AND is_deleted='0'");
		// var_dump($user->row()->stand_id); die;
		if(empty($user->row()->stand_id))
		{
			return 0;
		}
		return $user->row()->stand_id;
	}
	function getIncomeReport($partyId,$stand_id,$fromDate,$toDate)
	{
		$user = $this->db->query("SELECT date,income FROM party_detail_income WHERE party_id='$partyId' AND is_deleted='0' AND date BETWEEN '$fromDate' AND '$toDate'");
		// var_dump($user->result_array()); die;
		if(empty($user->result_array()))
		{
			return 0;
		}
		return $user->result_array();
	}
	function getPartyName($partyId)
	{
		$party_Name = $this->db->query("SELECT * FROM party_details WHERE id = '$partyId' AND is_deleted='0'");
		if (empty($party_Name->row()->name)) 
		{
			return '';
		}
		return $party_Name->row()->name;
	}
	function getPartyNumber($partyId)
	{
		$party_Name = $this->db->query("SELECT * FROM party_details WHERE id = '$partyId' AND is_deleted='0'");
		if (empty($party_Name->row()->mobile_no)) 
		{
			return '';
		}
		return $party_Name->row()->mobile_no;
	}
	function getLatestRef($partyId)
	{
		$ref = "";
		$result = $this->db->query("SELECT * FROM exhibition_stand WHERE party_id = '$partyId' AND is_deleted='0' ORDER BY reference DESC");
		return $result->row()->reference;

	}
	function getExtraTotal($partyId)
	{
		$sum = 0;
		$result = $this->db->query("SELECT * FROM exhibition_stand WHERE party_id = '$partyId' AND is_deleted='0'");
		// $result->result_array();
		foreach ($result->result_array() as $value) {
			$sum += $value['extra'];
		}
		return $sum;
	}
	function getTotalComPaid($partyId)
	{
		$sum = 0;
		$result = $this->db->query("SELECT * FROM exhibition_stand WHERE party_id = '$partyId' AND is_deleted='0'");
		foreach($result->result_array() as $value)
		{
			$sum += $value['comission_paid'];
		}
		return $sum;
	}
	function getTotalCOunters($partyId)
	{
		$string = '';
		$result = $this->db->query("SELECT * FROM exhibition_stand WHERE party_id = '$partyId' AND is_deleted='0'");
		foreach($result->result_array() as $value)
		{
			if(empty($string))
			{
				$string .= $value['stand_no'];
				continue;
			}
			$string .= ','.$value['stand_no'];
			
		}
		return $string;
	}
}
