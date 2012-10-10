<?php
/*
 * 管理员 管理用户
 * Created on 2012-9-22
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Admin_user extends CI_Controller
 {
 	/**
 	 *构造函数
 	 *
 	 *登陆检验
 	 *
 	 */
 	 function  __construct()
 	 {
 	 	parent::__construct();
 	 	$this->load->library("session");
 	 	if(!$this->session->userdata('logged_in'))
 	 	{
 	 		redirect('login');//登陆界面的地址（相对）
 	 		exit();
 	 	}
 	 }
 	 
 	 //--------------------------------------------------------------------------------------------------------
 	 /**
 	  *管理员列表
 	  *
 	  *
 	  */ 	
 	  function index()
 	  {
 	  	//echo "admin_user line 37";
 	  	$this->load->model('admin_user_model');
 	  	
 	  	$data['admin_users'] = $this->admin_user_model->find_admin_users();
 	  	
 	  	$this->load->view('admin/admin_list',$data);
 	  		//print_r($data);
 	  	
 	  }
 	  
 	  //-------------------------------------------------------------------------------------------------------------
 	  /**
 	   *添加管理员
 	   *
 	   *
 	   */
 	   function add()
 	   {
 	   	$this->edit(); 	   	
 	   }
 	   
 	   //--------------------------------------------------------------------------------------------------------------
 	   /**
 	    *更新管理员资料
 	    *
 	    *
 	    */
 	    function edit()
 	    {
 	    	//检查操作权限
 	    	//echo "USER67";
 	    	if(!admin_priv('admin_user_add'))
 	    	{
 	    		//echo "USER69";
 	    		return show_message2('你没有添加管理员的权限！','admin_user');
 	    	}
 	    	if(!admin_priv('admin_user_edit'))
 	    	{
 	    		//echo "USER69";
 	    		return show_message2('你没有编辑管理员的权限！','admin_user');
 	    	}
 	    	$params = $this->uri->uri_to_assoc(); //将url分成a=>b(a/b)的数组
 	    	//print_r($params);
 	    	if(!empty($params['id']) && $params['id'] > 0)
 	    	{
 	    		//echo "user77";
 	    		$id = $params['id'];
 	    		//echo " id".$id;
 	    		$this->load->model('admin_user_model');
 	    		$data['editing'] = $this->admin_user_model->load($id);
 	    		//print_r($data);
 	    		if(!$data['editing'])
 	    		{
 	    			//echo "user 84";
 	    			return show_message2('无效ID'.$id,'admin_user');
 	    		}
 	    		$data['header_text'] = '编辑管理员(ID:'.$data['editing']['mID'].')';
 	    	}
 	    	else
 	    	{
 	    		//echo "user89";
 	    		$data['editing'] = array(
                'mID' => null,
                'Mname' => null,
				'Memail' => null,
				'role_id' => null,			
            	);
			$data['header_text'] = '添加管理员';
       	 	}
        
			// 角色结果集
			$this->load->model('role_model');			
			$data['roles'] = $this->role_model->find_roles();
			//print_r($data);
			$this->load->view('admin/admin_edit',$data);
 	    }
 	    
 	    //---------------------------------------------------------------------------------------------------
 	    /**
 	     *提交数据保存
 	     * 
 	     *  
 	     */ 	     
 	     function save()
 	     {
 	     	//保存后并继续编辑信号
 	     	$re_edit = $this->input->post('re_edit');
 	     	
 	     	//管理员id
 	     	$id = $this->input->post('id');
 	     	//echo $id;
 	     	$name = $this->input->post('name');
 	     	$email = $this->input->post('email');
 	     	$new_pw = $this->input->post('new_pw');
 	     	$old_pw = $this->input->post('old_pw');
 	     	$role_id = $this->input->post('role_id');
 	     	
 	     	
 	     	//对是否更新密码的处理，用户密码更新
 	     	if($id)
 	     	{
 	     		$this->load->model('admin_user_model');
 	     		//找到要操作的用户id
 	     		$admin_user = $this->admin_user_model->load($id);
 	     		if(!$admin_user)
 	     		{
 	     			return show_message2('无效ID'.$id , 'admin_user');
 	     		}
 	     		
 	     		if($new_pw)  //输入了新的密码
 	     		{
 	     			//旧密码验证
 	     			if(md5($old_pw) == $admin_user['Mpass'])
 	     			{
 	     				$password = char_limit1($new_pw,32);
 	     			}
 	     			else
 	     			{
 	     				return show_message2('输入的旧密码错误','admin_user/edit/id'.$id);
 	     			}
 	     		}
 	     		//没有输入新密码
 	     		else
 	     		{
 	     			$password = '';
 	     		}
 	     	}
 	     	//创建新用户
 	     	else
 	     	{
 	     		$password = char_limit1($this->input->post('password'),32);
 	     	}
 	     	
 	     	//加载表单验证类
 	     	$this->load->library('form_validation');
 	     	
 	     	//设置表单验证规则
 	     	$this->set_save_form_rules();
 	     	
 	     	//如果提交的数据符合所设置的规则，则继续执行	
 	     	if($this->form_validation->run() == TRUE)
 	     	{
 	     		//将数据提交给数据模型
 	     		$this->load->model('admin_user_model');
 	     		$this->admin_user_model->name = $name;
 	     		$this->admin_user_model->email = $email;
 	     		$this->admin_user_model->password = $password; 	     		
 	     		$this->admin_user_model->role_id = $role_id;
 	     		
 	     		//更新管理员资料
 	     		if($id)
 	     		{
 	     			if($this->session->userdata('id') == $id )
 	     			{
 	     				$this->session->set_userdata('name',$name);
 	     			}
 	     			
 	     			$this->admin_user_model->update($id);
 	     			
 	     			if($re_edit)
 	     			{
 	     				show_message2('"管理员（ID:'.$id.')"已保存!','admin_user/edit/id/'.$id);
 	     			}
 	     			else
 	     			{
 	     				show_message2('保存成功！','admin_user');
 	     			} 		     			
 	     		}
 	     		//添加新管理员
 	     		else
 	     		{
 	     			
 	     			$this->admin_user_model->create();
 	     			if($re_edit)
 	     			{
 	     				$newly_one = $this->admin_user_model->get_newly_one();
 	     				show_message2('"管理员（ID:'.$newly_one['id'].')"已保存！','admin_user/edit/id'.$newly_one['id']);
 	     			}
 	     			else
 	     			{
 	     				show_message2('保存成功！','admin_user');
 	     			}
 	     		} 	     		
 	     	}
 	     	else
 	     	{
 	     		//数据不合规则的提示（还没有写）
 	     		//echo "数据不合规则的提示";
 	     		show_message2('数据不合规则的提示！','admin_user');
 	     	}     	
 	     }
 	     
 	     //---------------------------------------------------------------------------------------------------
 	     /**
 	      * 删除管理员
 	      *
 	      *
 	      */
 	     function delete()
 	     {
 	     	//检查权限
 	     	if(!admin_priv('admin_user_del'))
 	     	{
 	     		return show_message2('你没有删除该管理员的权限！','admin_user');
 	     	}
 	     	
 	     	$params = $this->uri->uri_to_assoc();
 	     	
 	     	//如果id被提交而且还是有效的则开始执行下面的。param代表现在要操作的id
 	     	if(isset($params['id']) && ($id = $params['id']) > 0)
 	     	{
 	     		if($params['id'] == $this->session->userdata('id'))
 	     		{
 	     			return show_message2('你不能删除自己！','admin_user');
 	     		}
 	     		
 	     		$this->load->model('admin_user_model');
 	     		$admin_user = $this->admin_user_model->load($id);
 	     		//$admin_user = $this->admin_user_model->load($id);
 	     		
 	     		if($this->admin_user_model->delete($id))
 	     		{
 	     			show_message2('"管理员(ID:'.$id.')" 已被删除!', 'admin_user');
 	     		}
 	     		else
 	     		{
 	     			return show_message2('无效ID'.$id,'admin_user');
 	     		}
 	     	}
 	     }
 	     
 	     //-----------------------------------------------------------------------------------------------------
 	     /**
 	      * 设置表单规则
 	      * 
 	      * 
 	      */
 	     function set_save_form_rules()
 	     {
 	     	//管理员名字
 	     	$rules['name'] = 'trim|required';
 	     	$rules['email'] = 'valid_email';
 	     	$rules['password'] = 'less_than[6]|required';
 	     	$this->form_validation->set_rules($rules);
 	     }
 	     
 }
?>

