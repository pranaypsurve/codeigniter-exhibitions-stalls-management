<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Login_m extends CI_Model
{	
	
	public function login_valid($user,$passwd)
	{
		// var_dump($user); die;
		$this->load->database();
		 $query = $this->db->where(['username'=> $user, 'password'=>$passwd])
		->get('users');
					// $this->db->where('username',$user);
					// $this->db->where('password',$passwd);
		// $query = $this->db->get('users')->row_array();
		// return $query;
		if($query->num_rows())
		{
			return $query->row();
		}else{
			return FALSE;
		}
	}
}
?>