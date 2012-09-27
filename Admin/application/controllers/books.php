<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Created on 2012-9-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class Books extends CI_Controller
 {
 	/**
 	 * 构造函数
 	 * 
 	 * 登陆检验
 	 */
 	function __construct()
 	{
 		parent::__construct();
 		if(!$this->session->userdata('logged_in'))
 		{
 			redirect('login');
 			exit();
 		}
 	}
 	
 	//-------------------------------------------------------------------------------------------------------------------
 	/*
 	 * 初始化
 	 * 
 	 */
 	 function index()
 	 {
 	 	echo "books.php";
 	 }
 	 
 } 
 
?>
