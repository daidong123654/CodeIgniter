<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_model extends CI_Model {
	
	var $name = "";
	var $password = "";
	var $posttime = "";
	
	public function __construct()
	{
		$this->load->database();
	}
	public function CheckLogin()
	{
		$this->db->get('lib_manager');
		$this->db->where("Mname","Mpass",$AdminName,$AdminPassword);
		
		
		
	}
	public function AdminSelect()
	{
		
	}

}
?>
