<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 
 * 视图框架
 * Created on 2012-9-24
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class Frameset extends CI_Controller
 {
 	/**
 	 *构造函数
 	 *
 	 * 登陆检验 
 	 */
 	 function __construct()
 	 {
 	 	//echo "19919191919191";
 	 	parent::__construct();
 	 	/*if(!$this->session->userdata('login_in'))=============================================!!!!!!!!!!!!!!!!!!!!!!!
 	 	{
 	 		//echo "aaaaaaaaaaaaaaaaa";
 	 		redirect('login');	
 	 		exit();
 	 	}*/ 	 	
 	 }
 	 
 	 //-------------------------------------------------------------------------------------------------------
 	 /**
 	  * 框架集
 	  * 
 	  * 
 	  */
 	  function index()
 	  {
 	  	//echo "aaaaaaaaaaaaaaaaa";
 	  	$this->load->view('_frameset');  //登陆后初始化界面为书籍界面
 	  	                   
 	  }
 	  
 	  //------------------------------------------------------------------------------------------------------------
 	  /**
 	   *顶部菜单 
 	   * 
 	   * 
 	   */
 	   function top()
 	   {
 	   	//echo "aaaaaaaaaaaaaaaaa";
 	   	$this->load->view('_top');
 	   }
 	   
 	   //-----------------------------------------------------------------------------------------------------
 	   /**
 	    * 左侧菜单
 	    * 
 	    * 
 	    */       //menu($type = 'dashboard')
 	    function menu($type = 'books')
 	    {
 	    	//echo "aaaaaaaaaaaaaaaaa";
 	    	switch($type)
 	    	{
 	    		case 'books'   : $this->load->view('books/menu');   break;   //1书籍
 	    		case 'readers' : $this->load->view('eaders/menu');  break;	 //2读者
 	    		case 'news'    : $this->load->view('news');			break;   //3新闻
 	    		case 'message' : $this->load->view('message/menu'); break;   //4留言
 	    		case 'borrow'  : $this->load->view('borrow/menu');  break;   //5借阅
 	    		case 'admin'   : $this->load->view('admin/menu');   break;   //6管理员
 	    		case 'system'  : $this->load->view('system');		break;   //7 系统设置 
 	    	}
 	    }
 }
?>


















