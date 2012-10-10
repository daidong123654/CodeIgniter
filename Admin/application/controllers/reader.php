<?php
/*
 * Created on 2012-10-9
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class reader extends CI_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 	}
 	
 	function index()
 	{		
 		$page = $this->input->post('page');
 		$page = (int)$page;
 		
 		//分页显示url
 		$segments = $this->uri->uri_to_assoc();
 		$search_uri = '';
 		
 		//计算查询条件
        $options = array(
            'conditions' => null
        );
 		
 		//分页查询数据
 		if($page)
 		{
            $page_offset = $page-1;
		}
		else if (!empty($segments['page']))
		{
            $page_offset = (int)$segments['page'];		
        } 
        else 
        {
            $page_offset = 0;
        }
		if ($page_offset<0)
		{
            $page_offset=0;
		}
 		
 		//分页url
 		$base_url = site_url('reader/index/page').'/';
 		
 		//每页显示数据条数
 		$per_page = 2;
 		
 		//数据总数
 		$this->load->model('reader_model');
 		$data['total_rows'] = $this->reader_model->total_reader($options,'0');
 		
 		//total pages
 		$data['total_pages'] = ceil($data['total_rows'] / $per_page);
 		
 		//当前页(input)
 		$data['page'] = $page_offset + 1;
 		$data['page'] = ($data['page']>$data['total_pages'] && $data['total_pages']>0) ? $data['total_pages'] : $data['page'];
 		
 		//first last prev next page
 		$data['page_first'] = $base_url.'0'.$search_uri;
		$data['page_last'] = $base_url.($data['total_pages']-1).$search_uri;
		$data['page_prev'] = ($data['page']>1) ? $base_url.($data['page']-2).$search_uri : $data['page_first'];
	    $data['page_next'] = ($data['page']<$data['total_pages']) ? $base_url.($data['page']).$search_uri : $data['page_last'];
 		
 		//当前页码
 		$data['cur_page'] = $base_url.($data['page'] - 1).$search_uri;
 		
 		//当前页起始数据号
 		$data['show_start'] = ($data['page'] - 1)*$per_page+1;
 		
 		//当前页结束数据号
 		$data['show_end'] = ($page_offset < $data['total_pages'] - 1) ? ($data['show_start'] + $per_page) : $data['total_rows'];
 		
 		//读者结果集
 		$data['readers'] = $this->reader_model->find_readers($options,$per_page,($data['page'] - 1)*$per_page);
 		
 		//print_r($data['readers']);
 		
 		// ajax
		if (!empty($segments['ajax']))
		{
			$this->load->view('reader/ajax_list',$data);
		// 非 ajax
		}
		else
		{
            $this->load->view('reader/list',$data);
		}
 	}
 	
 	//------------------------------------------------------------------^8^--------------------------
 	/**
 	 *增加
 	 * 
 	 */ 	
 	function add()
 	{
 		//echo 'add';
 		//检查权限
 		if(!admin_priv('reader_add'))
 		{
 			return show_message2('你没有增加用户的权限!','reader');
 		}
 		else
 		{
 			$this->edit();
 		} 		
 	}
 	
 	//---------------------------------------------------------------------------------------------------
 	/**
 	 * 编辑
 	 * 
 	 */
 	 function edit()
 	 {
 	 	//检出权限
 	 	if(!admin_priv('reader_edit'))
 	 	{
 	 		return show_message2('你没有编辑用户的权限！','reader');
 	 	}
 	 	
 	 	$params = $this->uri->uri_to_assoc();
 	 	if(!empty($params['id']) && $params['id'] > 0 )
 	 	{
 	 		$id = $params['id'];
 	 		$this->load->model('reader_model');
 	 		$data['editing'] = $this->reader_model->load($id);
 	 		if(!$data['editing'])
 	 		{
 	 			return show_message2('无效ID'.$id,'reader');
 	 		}
 	 		$data['header_text'] = '编辑读者（ID:'.$data['editing']['id'].')';
 	 	}
 	 	else
 	 	{
 	 		$data['editing'] = array(
 	 			'id'    => null,
 	 			'name'  => null,
 	 			'Email' => null,
 	 			'password' => null,
 	 			'papertype' => null,
 	 			'papercode' =>null,
 	 			'typeid' => null,
 	 			
 	 			//一般信息
 	 			'barcode' => null,
 	 			'sex'    => null,
 	 			'age'    => null,
 	 			'birthday' => null,
 	 			'teltphone' => null,  
 	 			'remark'   => null,
 	 			'credit'   => null 	 			
 	 			);
 	 		$data['header_text'] = '添加读者';
 	 	}
 	 	$this->load->view('reader/edit',$data);
 	 }
 	 
 	 //----------------------------------------------------------------------------------------------------
 	 /**
 	  * 提交数据
 	  * 
 	  */
 	  function save()
 	  {
 	  	$re_edit = $this->input->post('re_edit');
 	  	
 	  	//id
 	  	$id = $this->input->post('id');
 	  		
 	  	//post data
 	  	$name = $this->input->post('name');
 	  	$Email = $this->input->post('Email');
 	  	$password = $this->input->post('password');
 	  	$papertype = $this->input->post('papertype');
 	  	$papercode = $this->input->post('papercode');
 	  	
 	  	$typeid = $this->input->post('typeid');
 	  	$barcode = $this->input->post('barcode');
 	  	$sex = $this->input->post('sex');
 	  	$age = $this->input->post('age');
 	  	$birthday = $this->input->post('birthday');
 	  	$teltphone = $this->input->post('telephone');
 	  	$remark = $this->input->post('remark');
 	  	$credit = $this->input->post('credit');
 	  	/*
 	  	'id' 'name' 'Email''password' 'papertype' 'papercode''typeid'	
 	 	'barcode''sex''age''birthday''teltphone' 'remark''credit'
 	 	*/	 
 	 	
 	 	//表单验证
 	 	$this->load->library('form_validation');
 	 	
 	 	//rules
 	 	$this->set_save_form_rules();
 	 	
 	 	if($this->form_validation->run() == TRUE)
 	 	{
 	 		//将数据提交到模型
 	 		$this->load->model('reader_model');
 	 		
 	 		$this->reader_model->name = $name;
 	 		$this->reader_model->password = $password;
 	 		$this->reader_model->papertype = $papertype;
 	 		$this->reader_model->papercode = $papercode;
 	 		$this->reader_model->Email = $Email;
 	 		$this->reader_model->typeid = $typeid;
 	 		
 	 		$this->reader_model->barcode = $barcode;
 	 		$this->reader_model->sex = $sex;
 	 		$this->reader_model->age = $age;
 	 		$this->reader_model->birthday = $birthday;
 	 		$this->reader_model->telephone = $teltphone;
 	 		$this->reader_model->remark = $remark;
 	 		$this->reader_model->credit = $credit;
 	 		
 	 		//update
 	 		if($id)
 	 		{
 	 			$this->reader_model->update($id);
 	 			if($re_edit)
 	 			{
 	 				show_message2('"读者（ID'.$id.')"已保存！','reader/edit/id/'.$id);
 	 			}
 	 			else
 	 			{
 	 				show_message2('读者'.$id.'已更新！','reader');
 	 			}
 	 		}
 	 		//添加
 	 		else
 	 		{
 	 			$this->reader_model->create();
 	 			if($re_edit)
 	 			{
 	 				$newly_one = $this->reader_model->get_newly_one();
 	 				show_message2('"读者(ID:'.$newly_one['id'].')" 已保存!', 'reader/edit/id/'.$newly_one['id']);
 	 			}
 	 			else
 	 			{
 	 				show_message2('保存成功！','reader');
 	 			}
 	 		}
 	 	}
 	 	else
 	 	{
 	 		show_message2('数据格式错误！','reader');
 	 	}
 	 	
 	  }	
 	  
 	  //--------------------------------------------
 	  /**
 	   * 表单验证规则
 	   * 
 	   */
 	   function set_save_form_rules()
 	   {
 	   		$rules['name'] = 'trim|required';
 	   		$rules['Email'] = 'valid_email|required';
 	   		$rules['password'] = 'less_than[6]|required';
 	   		$rules['papertype'] = 'required';
 	   		$rules['papercode'] = 'required';
 	   		$rules['typeid'] = 'required'; 
 	   }
 	   
 	   //---------------------------------------------------------
 	   /**
 	    * delete
 	    * 
 	    */
 	    function delete()
 	    {
 	    	if(!admin_priv('reader_del'))
 	    	{
 	    		return show_message2('你没有删除读者的权限！','reader');
 	    	}
 	    	
 	    	$params = $this->uri->uri_to_assoc();
 	    	if(isset($params['id']) && ($id = $params['id']) > 0)
 	    	{
 	    		$this->load->model('reader_model');
 	    		if($this->reader_model->delete($id))
 	    		{
 	    			show_message2('"读者(ID:'.$id.')" 已被删除!', 'reader');
 	    		}
 	    		else
 	    		{
 	    			return show_message2('"无效'.$id.' !', 'reader');
 	    		}
 	    	}
 	    }
 	    
 	    //---------------------------------------------------------
 	   /**
 	    * in recycle
 	    * 
 	    */
 	    function in_recycle()
 	    {
 	    	if(!admin_priv('reader_del'))
 	    	{
 	    		return show_message2('你没有删除读者的权限！','reader');
 	    	}
 	    	
 	    	$params = $this->uri->uri_to_assoc();
 	    	if(isset($params['id']) && ($id = $params['id']) > 0)
 	    	{
 	    		$this->load->model('reader_model');
 	    		if($this->reader_model->in_recycle($id))
 	    		{
 	    			show_message2('"读者(ID:'.$id.')" 已被放回回收站!', 'reader');
 	    		}
 	    		else
 	    		{
 	    			return show_message2('"无效'.$id.' !', 'reader');
 	    		}
 	    	}
 	    }
 	    
 	    //---------------------------------------------------------
 	   /**
 	    * out recycle
 	    * 
 	    */
 	    function out_recycle()
 	    {
 	    	if(!admin_priv('reader_del'))
 	    	{
 	    		return show_message2('你没有权限！','reader');
 	    	}
 	    	
 	    	$params = $this->uri->uri_to_assoc();
 	    	if(isset($params['id']) && ($id = $params['id']) > 0)
 	    	{
 	    		$this->load->model('reader_model');
 	    		if($this->reader_model->out_recycle($id))
 	    		{
 	    			show_message2('"读者(ID:'.$id.')" 已还原!', 'reader');
 	    		}
 	    		else
 	    		{
 	    			return show_message2('"无效'.$id.' !', 'reader');
 	    		}
 	    	}
 	    }
 	    
 	    
 	    //--------------------------------------------------------------
 	    /**
 	     * 回收站管理
 	     * 
 	     */
 	     function recycle()
	 	{	 		
	 		$page = $this->input->post('page');
	 		$page = (int)$page;
	 		
	 		//分页显示url
	 		$segments = $this->uri->uri_to_assoc();
	 		$search_uri = '';
	 		
	 		//计算查询条件
	        $options = array(
	            'conditions' => null,
	        );
	 		
	 		//分页查询数据
	 		if($page)
	 		{
	            $page_offset = $page-1;
			}
			else if (!empty($segments['page']))
			{
	            $page_offset = (int)$segments['page'];		
	        } 
	        else 
	        {
	            $page_offset = 0;
	        }
			if ($page_offset<0)
			{
	            $page_offset=0;
			}
	 		
	 		//分页url
	 		$base_url = site_url('reader/recycle/page').'/';
	 		
	 		//每页显示数据条数
	 		$per_page = 1;
	 		
	 		//数据总数
	 		$this->load->model('reader_model');
	 		$data['total_rows'] = $this->reader_model->total_reader($options,'1');
	 		
	 		//total pages
	 		$data['total_pages'] = ceil($data['total_rows'] / $per_page);
	 		
	 		//当前页(input)
	 		$data['page'] = $page_offset + 1;
	 		$data['page'] = ($data['page']>$data['total_pages'] && $data['total_pages']>0) ? $data['total_pages'] : $data['page'];
	 		
	 		//first last prev next page
	 		$data['page_first'] = $base_url.'0'.$search_uri;
			$data['page_last'] = $base_url.($data['total_pages']-1).$search_uri;
			$data['page_prev'] = ($data['page']>1) ? $base_url.($data['page']-2).$search_uri : $data['page_first'];
		    $data['page_next'] = ($data['page']<$data['total_pages']) ? $base_url.($data['page']).$search_uri : $data['page_last'];
	 		
	 		//当前页码
	 		$data['cur_page'] = $base_url.($data['page'] - 1).$search_uri;
	 		
	 		//当前页起始数据号
	 		$data['show_start'] = ($data['page'] - 1)*$per_page+1;
	 		
	 		//当前页结束数据号
	 		$data['show_end'] = ($page_offset < $data['total_pages'] - 1) ? ($data['show_start'] + $per_page) : $data['total_rows'];
	 		
	 		//读者结果集
	 		$data['readers'] = $this->reader_model->find_readers($options,$per_page,($data['page'] - 1)*$per_page,'1');
	 		
	 		//print_r($data['readers']);
	 		
	 		// ajax
			if (!empty($segments['ajax']))
			{
				$this->load->view('reader/ajax_list',$data);
			// 非 ajax
			}
			else
			{
	            $this->load->view('reader/recycle_list',$data);
			}
	 	}
 	
 }
?>



















