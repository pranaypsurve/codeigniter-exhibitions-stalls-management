<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_m extends CI_Model
{
	function __construct()
	{
		
	}
	function getAllExpense()
	{
		$this->db->where('is_deleted','0');
		$all_expense = $this->db->get('expense')->result_array();
		return $all_expense;
	}
	function insert_add_expense($formArray)
	{
		$this->db->insert('expense',$formArray);
	}
	function update_add_expense($expense_id,$formArray)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('expense_id',$expense_id);
		$this->db->update('expense',$formArray);
	}
	function getExpenseById($expense_id)
	{
		$this->db->where('is_deleted','0');
		$this->db->where('expense_id',$expense_id);
		return $this->db->get('expense')->row();
	}
	function delete_expense($expense_id)
	{
		$data = array(
        'is_deleted' => 1
    	);
    	$this->db->where('expense_id',$expense_id);
    	$this->db->update('expense', $data);
	}
}