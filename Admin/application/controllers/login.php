<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 登陆
 * Created on 2012-9-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class Login extends CI_Controller
 {
 	/**
 	 *构造函数
 	 *  
 	 * 
 	 */
 	 function __construct()
 	 {
 	 	parent::__construct();
 	 }
 	 
 	 //----------------------------------------------------------------------------------------------------
 	 /**
 	  *登陆界面（初始化） 
 	  * 
 	  * 
 	  */
 	  function index()
 	  {
 	  	$data = array();
 	  	$this->load->view('admin/admin_login',$data);
 	  }
 	  
 	  //----------------------------------------------------------------------------------------------------
 	  /**
 	   * 登陆检验
 	   * 
 	   * 
 	   */
 	   function signin()
 	   {
 	   	if($this->input->post('act') == 'signin')
 	   	{
 	   		//接受客户端数据
 	   		$name = $this->input->post('name');
 	   		$password = $this->input->post('password');
 	   		
 	   		//echo $name."<br/>";
 	   		//echo $_POST['name']."<br/>";
 	   		//echo $password."<br/>";
 	   		
 	   		//把数据提交给模型
 	   		$this->load->model('admin_user_model');
 	   		$this->admin_user_model->name = $name;
 	   		$this->admin_user_model->password = $password;
 	   		
 	   		if($user = $this->admin_user_model->signin())
 	   		{
 	   			//session记录登录信息
 	   			$users = array(
 	   				'name'         => $user['Mname'],
 	   				'id'           => $user['mID'],
 	   				'role_id'      => $user['role_id'],
 	   				'action_list'  => $user['action_list'],
 	   				'logged_in'    => TRUE
 	   			);
 	   			$this->session->set_userdata($users);
 	   			
 	   			echo 1;
 	   			redirect('frameset') ;   			
 	   		}
 	   		//用户名和密码不匹配
 	   		else
 	   		{
 	   			echo 2;
 	   			//show_message2('用户名或者密码错误！','login'); 	   			
 	   			//redirect('login');
 	   			echo "用户名或者密码错误！";
 	   			$this->load->view('admin/admin_login');
 	   		} 	   		
 	   	} 
 	   	//非法登陆
 	   	else
 	   	{
 	   		redirect('login');
 	   		echo "78";
 	   	}	   	
 	   	
 	   }
 	   
 	   //----------------------------------------------------------------------------------------------
 	   /**
 		* 注销
		 *
 		*
 		*/
		function logout()
    	{        	
			$this->session->sess_destroy();
			redirect('login');
    	}
   
 	  
}
?>





















