<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_m extends CI_Model
{
	function __construct()
	{
		
	}
	function getAllIncome()
	{
		$this->db->where('is_deleted','0');
		$all_income = $this->db->get('income')->result_array();
		return $all_income;
	}
	function insert_add_income($formArray)
	{
		$this->db->insert('income',$formArray);
	}
	function update_add_income($income_id,$formArray)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('income_id',$income_id);
		$this->db->update('income',$formArray);
	}
	function getIncomeByIncomeId($income_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('income_id',$income_id);
		return $this->db->get('income')->row();
	}
	function delete_income($income_id)
	{
		$data = array(
        'is_deleted' => 1
    	);
    	$this->db->where('income_id',$income_id);
    	$this->db->update('income', $data);
	}
}