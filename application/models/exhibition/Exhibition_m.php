<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Exhibition_m extends CI_Model
{
	public function getAllExhibition()
	{
		$this->db->where('is_deleted','0');
		 return $this->db->get('exhibition')->result_array();
	}
	public function getAllStand($exhibition_Id)
	{
		$this->db->where('is_deleted','0');
		$this->db->order_by("stand_id", "asc");
		$this->db->order_by("exhibition_id", "asc");
		$this->db->where('exhibition_id',$exhibition_Id);
		return $user = $this->db->get('exhibition_stand_vw')->result_array();
	}
	public function getExhibition($exhibition_Id)
	{
		$this->db->where('id',$exhibition_Id);
		return $user = $this->db->get('exhibition')->row_array();
	}
	public function getStand($stand_id)
	{
		$this->db->where('stand_id',$stand_id);
		return $user = $this->db->get('exhibition_stand')->row_array();
	}
	public function create($formArray)
	{
		$this->db->insert('exhibition',$formArray);
	}
	public function update($exhibition_Id,$formArray)
	{
		$this->db->where('id',$exhibition_Id);
		$this->db->update('exhibition',$formArray);
	}
	public function addStand($formArray)
	{
		$this->db->insert('exhibition_stand',$formArray);
		// return $this->db->insert_id();
	}
	public function updateStand($stand_id,$formArray)
	{
		$this->db->where('stand_id',$stand_id);
		$this->db->update('exhibition_stand',$formArray);
	}
	function addIncome($formArray)
	{
		$this->db->insert('party_detail_income',$formArray);
	}
	function updateincomedata($exhibition_Id,$stand_id,$formArray,$income_id)
	{
		$this->db->where('is_deleted','0');
		// $this->db->where('exhibition_Id',$exhibition_Id);
		// $this->db->where('stand_id',$stand_id);
		$this->db->where('income_id',$income_id);
		$this->db->update('party_detail_income',$formArray);
	}
	function getincomedata($exhibition_Id,$stand_id,$income_id)
	{
		$this->db->where('is_deleted','0');
		// $this->db->where('stand_id',$stand_id);
		$this->db->where('income_id',$income_id);
		return $this->db->get('party_detail_income')->row_array();
	}
	function getAllIncome($stand_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('stand_id',$stand_id);
		return $this->db->get('party_detail_income')->result_array();
	}
	function getTotalIncomeByStandid($stand_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('stand_id',$stand_id);
		$temp = $this->db->get('party_detail_income')->result_array();
		$total = 0;
		foreach ($temp as $row) {
			$total += $row['income'];
		}
		$totalEarning = $total;
		$totalComission = $total * 20 / 100;
		$commissionBalance = $totalComission;
		return array(
			'total'			 => $total,
			'totalComission' => $totalComission,
			'totalEarning'	 => $totalEarning,
			'commissionBalance' => $totalComission,
		);
	}
	function updateTotalEarning($exhibition_Id,$stand_id,$totalEarning)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('exhibition_id',$exhibition_Id);
		$this->db->where('stand_id',$stand_id);
		$data['total_earning'] = $totalEarning;
		$this->db->update('exhibition_stand',$data);
	}
	function updateComissionBalance($exhibition_Id,$stand_id,$commissionBalance,$lastbackbalance=0)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('exhibition_id',$exhibition_Id);
		$this->db->where('stand_id',$stand_id);
		$data['comission_balance'] = $commissionBalance + $lastbackbalance;
		$this->db->update('exhibition_stand',$data);
	}
	function updateTotalComission($exhibition_Id,$stand_id,$totalComission,$lastbackbalance=0)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('exhibition_id',$exhibition_Id);
		$this->db->where('stand_id',$stand_id);
		$data['total_comission'] = $totalComission + $lastbackbalance;
		$this->db->update('exhibition_stand',$data);
	}

	function getStandComissionPaid($stand_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('stand_id',$stand_id);
		$comission_paid = $this->db->get('exhibition_stand')->row();
		return $comission_paid->comission_paid;
	}
	function getStandComissionBalance($stand_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('stand_id',$stand_id);
		$comission_balance = $this->db->get('exhibition_stand')->row();
		return $comission_balance->comission_balance;
	}
	function getStandBackBalance($stand_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('stand_id',$stand_id);
		$backbalance = $this->db->get('exhibition_stand')->row();
		return $backbalance->back_balance;
	}
	function getStandExtra($stand_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('stand_id',$stand_id);
		$extra = $this->db->get('exhibition_stand')->row();
		return $extra->extra;
	}
	// function getBackBalanceByStandId($exhibition_Id,$stand_id)
	// {
	// 	$this->db->where('is_deleted','0');
	// 	$this->db->where('exhibition_Id',$exhibition_Id);
	// 	$this->db->where('stand_id',$stand_id);
	// 	$backbalance = $this->db->get('exhibition_stand')->row();
	// 	return $backbalance->extra;
	// }
	function getPartyNumberByPartyId($party_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('id',$party_id);
		$partyNumber = $this->db->get('party_details')->row();
		return $partyNumber->mobile_no;
	}
	
	function updateBackBalance($party_id,$back_balance)
	{
		// $new_comissionBalance = 0;
		// $retrive_comissionBalance = $this->db->query("SELECT comission_balance FROM exhibition_stand WHERE party_id='$party_id' AND is_deleted='0'");
		
		// if(empty($retrive_comissionBalance->result_array()))
		// {
		// 	$new_comissionBalance = 0;
		// }else{
		// 	foreach ($retrive_comissionBalance->result_array() as $value) {
		// 		$new_comissionBalance += $value['comission_balance'];
		// 	}
		// 	// var_dump($new_comissionBalance); die;
		// }
		// var_dump($old_backBalance); die;
		$this->db->where('is_deleted','0');
		$this->db->where('id',$party_id);
		$data['back_balance'] = $back_balance; //$back_balance + $old_backBalance;
		$this->db->update('party_details',$data);
	}
	function updateExhibitionTotcAndComb($exhibition_Id,$formArray)
	{
		$user = $this->getExhibition($exhibition_Id);
		$arrayexhibition = array();
		$arrayexhibition['comission_balance'] = $user['comission_balance'] += $formArray['comission_balance'];
		$arrayexhibition['total_comission'] = $user['total_comission'] += $formArray['total_comission'];
		$this->db->where('id',$exhibition_Id);
		$this->db->update('exhibition',$arrayexhibition);
	}
	public function updateExhibitionColumn($exhibition_Id,$stand_id,$formArray=null)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('exhibition_Id',$exhibition_Id);
		$user = $this->db->get('exhibition_stand')->result_array();
		// var_dump($user); die;
		$totalComission = 0;
		$comissionBalance = 0;
		$comissionReceived = 0;
		foreach ($user as $row) {
			$totalComission += $row['total_comission'];
			$comissionBalance += $row['comission_balance'];
			$comissionReceived += $row['comission_paid'];
		}
		$arrayexhibition = array();
		$arrayexhibition['commission_received'] = $comissionReceived;
		$arrayexhibition['comission_balance'] = $comissionBalance;
		$arrayexhibition['total_comission'] = $totalComission;
		// $arrayexhibition['commission_received'] = $user['commission_received'] += $formArray['comission_paid'];
		// $arrayexhibition['comission_balance'] = $user['comission_balance'] += $formArray['comission_balance'];
		// $arrayexhibition['total_comission'] = $user['total_comission'] += $formArray['total_comission'];
		$this->db->where('is_deleted','0');
		$this->db->where('id',$exhibition_Id);
		$this->db->update('exhibition',$arrayexhibition);
	}
	function deleteExhibition($exhibition_Id)
	{
		$data = array(
        'is_deleted' => 1
    	);
		$this->db->where('id',$exhibition_Id);
		$this->db->set('is_deleted', '1');
		$this->db->update('exhibition', $data);
	}
	function deleteStand($stand_id)
	{
		$data = array(
        'is_deleted' => 1
    	);
		$this->db->where('stand_id',$stand_id);
		$this->db->set('is_deleted', '1');
		$this->db->update('exhibition_stand', $data);
	}
	function deleteincome($stand_id,$income_id)
	{
		$data = array(
        'is_deleted' => 1
    	);
    	$this->db->where('stand_id',$stand_id);
    	$this->db->where('income_id',$income_id);
		$this->db->set('is_deleted', '1');
		$this->db->update('party_detail_income', $data);
	}
	function returnIncomeifexist($stand_id)
	{
		$this->db->where('is_deleted','0');
		$ifexists = $this->db->query('SELECT * FROM `party_detail_income` where `stand_id` = '.$stand_id)->row();
		if (!empty($ifexists->income)) 
		{
			return 1;		
		}
		return 0;
	}
	function getAllPartyDropDown($stand_id = null)
	{
		$this->db->where('stand_id',$stand_id);
		$query = $this->db->query('SELECT id,name FROM party_details where is_deleted=0');
		// var_dump($query->result_array()); die;
   		return $query->result_array();
	}
	function getPartySelected($exhibition_Id,$stand_id = null)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('exhibition_id',$exhibition_Id);
		$this->db->where('stand_id',$stand_id);
		
	}
	function getAllBackBalanceDESC($p_id)
	{
		$this->db->where('party_id',$p_id);
		$this->db->order_by('stand_id', 'DESC');
		$user = $this->db->get('exhibition_stand')->row();
		// var_dump($user);
		if (empty($user->back_balance)) 
		{
			return 0;		
		}
		return $user->back_balance;
	}
	function getBackBalance($p_id)
	{
		$backbalance = $this->db->query('SELECT * FROM `party_details` where `id` = '.$p_id)->row();
		if (empty($backbalance->back_balance)) 
		{
			return 0;		
		}
		return $backbalance->back_balance;
	}

}

?>