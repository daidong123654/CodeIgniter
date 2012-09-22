<?php
/*
 * 管理员
 * Created on 2012-9-22
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class admin_user extends CI_Controller
 {
 	/**
 	 *构造函数
 	 *
 	 *登陆检验
 	 *
 	 */
 	 function  __construct()
 	 {
 	 	parent::CI_Controller();
 	 	if(!$this->session->userdata('logged_in'))
 	 	{
 	 		redirect('login');
 	 		exit();
 	 	}
 	 } 	
 }
?>
