<?php
/*
 * Created on 2012-10-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class ISBN extends CI_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 	}
 	//---------------------------------------------------------------------------------
 	/**
 	 *初始化出版社列表 
 	 * 
 	 */
 	function index()
 	{
 		$this->load->model('ISBN_model');
 		$query = $this->ISBN_model->find_all_ISBN();
 		$data['editing'] = $query;
 		$totalISBNS = $this->ISBN_model->find_all_ISBN_count();
 		$data['totalISBNS'] = $totalISBNS;
 		$this->load->view('books/ISBN/list',$data);
 	}
 	
 	//-----------------------------------------------------------------------------------
 	/**
 	 * 增加
 	 * 
 	 */
 	function add()
 	{
 		$this->edit();
 	}
 	
 	//-----------------------------------------------------------
 	/**
 	 * 编辑 
 	 * 
 	 */
 	 function edit()
 	 {
 	 	$params = $this->uri->uri_to_assoc();
 	 	if(!empty($params['id']) && $params['id'] > 0)
 	 	{
 	 		$id = $params['id'];
 	 		$this->load->model('ISBN_model');
 	 		$data['editing'] = $this->ISBN_model->load($id);
 	 		if(!$data['editing'])
	  		{
	  			return show_message2('无效ID:'.$id,'ISBN');
	  		}
	  		$data['header_text'] = '编辑出版社(ID:'.$data['editing']['id'].')';
 	 	}
 	 	else
 	 	{
 	 		$data['editing'] = array( 	
 	 			'id'   => null, 			
 	 			'ISBN' =>  NULL,
 	 			'ISBNname' => null,
 	 			'phone'    => null,
 	 			'Email'    => null,
 	 			'created_at' => null 	 			
 	 		);
 	 		$data['header_text'] = '添加出版社';
 	 	}
 	 	$this->load->view('books/ISBN/ISBN_edit',$data);
 	 }
 	 
 	 //-------------------------------------------------
 	 /**
 	  * 提交数据
 	  * 
 	  */
 	  function save()
 	  {
 	  		//保存后并继续编辑信号
		 	$re_edit = $this->input->post('re_edit');
		 	
		 	//出版社id
		 	$id = $this->input->post('id');	 	
		 	//基本信息
		 	
 	 		$ISBN = $this->input->post('ISBN');
 	 		$ISBNname = $this->input->post('ISBNname');
 	 		$phone    = ( $this->input->post('phone') ) ? $this->input->post('phone') : 0;
 	 		$Email    = ( $this->input->post('Email') ) ? $this->input->post('Email') : 0;
 	 		 
 	 		//加载表单验证类
	 	 	$this->load->library('form_validation'); 	 	
	 	 	
	 	 	//设置表单验证数据规则
	 	 	$this->set_save_form_rules(); 
	 	 	//如果表单验证通过就继续
 	 		if($this->form_validation->run() == TRUE)
 	 		{
 	 			$datetime = date('Y-m-d H:i:s');
 	 			//把数据提交给模型  
 	 			$this->load->model('ISBN_model'); 	 			
 	 			
 	 			$this->ISBN_model->ISBN = $ISBN;
 	 			$this->ISBN_model->ISBNname = $ISBNname;
 	 			$this->ISBN_model->Email = $Email;
 	 			$this->ISBN_model->phone = $phone;
 	 			$this->ISBN_model->created_at = $datetime; 	
 	 			
 	 			//更新
 	 			if($id)
 	 			{
 	 				$this->ISBN_model->update($id);
 	 				
 	 				//继续编辑
			 	 	if($re_edit)
			 	 	{
			 	 		//echo $id;
			 	 		show_message2('"出版社(ID:'.$id.')" 已更新!', 'ISBN/edit/id/'.$id);
			 	 	}
			 	 	//返回列表
			 	 	else
			 	 	{
			 	 		show_message2('"出版社(ID:'.$id.')" 已更新!', 'ISBN');
			 	 	}
 	 			}
 	 			//新增
 	 			else
 	 			{
 	 				$this->ISBN_model->create();
 	 				$newly_one = $this->ISBN_model->get_newly_one();
 	 				if($re_edit)
			 	 	{
			 	 		//echo $bookID;
			 	 		show_message2('"出版社(ID:'.$id.')" 已添加!', 'ISBN/edit/id/'.$newly_one['id']);
			 	 	}
			 	 	//返回列表
			 	 	else
			 	 	{
			 	 		show_message2('"出版社(ID:'.$id.')" 已添加!', 'ISBN');
			 	 	}	
 	 			} 			
 	 		}
 	 		//插入失败
	 	 	else
	 	 	{
	 	 		show_message2('数据插入失败！','ISBN/eidt');
	 	 	}
 	  }
 	  
 	  //---------------------------------------------------------------
 	  /**
 	   * delete
 	   * 
 	   */
 	   function delete()
 	   {
 	   		$params = $this->uri->uri_to_assoc();
 	   		 if (isset($params['id']) && ($id = $params['id']) > 0)
 	   		 {
 	   		 	$id = $params['id'];
 	   		 	$this->load->model('ISBN_model');
 	   		 	$row = $this->ISBN_model->load($id);

 	   		 	//如果该出版社下面有书就不能删除
 	   		 	$this->load->model('ISBN_model');
 	   		 	$books = $this->ISBN_model->find_ISBN_books($id);
 	   		 	
 	   		 	if($books['booknum'] > 0)
 	   		 	{
 	   		 		show_message2('出版社'.$row['ISBNname'].' 有书！您不能删除!','ISBN');
 	   		 	}
 	   		 	else if($this->ISBN_model->delete($id))
 	   		 	{
 	   		 		 show_message2('"出版社(ID:'.$id.')" 已被删除!', 'ISBN');
 	   		 	}
 	   		 	else
 	   		 	{
 	   		 		return show_message2('无效ID:'.$id, 'ISBN');
 	   		 	}
 	   		 }
 	   }
 	   
 	   // --------------------------------------------------------------------
	    /**
		 * 设置表单数据规则
		 *
		 */	
		function set_save_form_rules()
	    {
	        $rules['ISBN'] = 'required|max_lenth[30]';
	        $rules['ISBNname']   = 'required|max_length[200]';	
	        $rules['Emain'] = 'valid_email';
	        $rules['phone'] = 'numeric';   
	               
			$this->form_validation->set_rules($rules);		
	    } 
 	 
 }
 
?>
