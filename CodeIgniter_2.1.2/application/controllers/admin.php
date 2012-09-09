<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin extends CI_Controller
{
	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('templates/header');
		$this->load->view("admin/admin_login");
		$this->load->view('templates/footer');
	}
	
	public function checkAdminLogin()
	{
		$admin=$this->admin_model->checkAdminLogin($_POST['Adminname']);	
		if($admin)
		{
			echo "用户存在";
		}
		else
		{
			echo "用户不存在";
		}
	}
	
	public function Admin_Login()
	{
		
	}
}
?>