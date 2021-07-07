<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Test extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$this->load->view('header/common/top_header_v.php');
		$this->load->view('test_v.php');
	}
}
