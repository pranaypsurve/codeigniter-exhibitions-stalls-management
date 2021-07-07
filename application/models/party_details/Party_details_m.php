<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Party_details_m extends CI_Model
{
	public function getAllRecords()
	{
		$this->db->where('is_deleted','0');
		return $test =  $this->db->get('party_details')->result_array();
	}
	public function getUser($user_id)
	{
		$this->db->where('id',$user_id);
		return $user = $this->db->get('party_details')->row_array();
	}
	function create($formArray)
	{
		$this->db->insert('party_details',$formArray);
	}
	function updateUser($userId,$formArray)
	{
		$this->db->where('id',$userId);
		$this->db->update('party_details',$formArray);
	}
	function deleteUser($userId)
	{
		$data = array(
        'is_deleted' => 1
    	);
		$this->db->where('id',$userId);
		$this->db->set('is_deleted', '1');
		$this->db->update('party_details', $data);
	}
}

?>