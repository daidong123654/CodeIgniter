<?php
/*
 * Created on 2012-9-16
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * 
 * 管理员
 */
 
 class Admin_user_model extends Model
 {
 	var $name;
 	var $email;
 	var $password;
 	
 	function __construct()
 	{
 		parent::Model();
 	}
 	
 	//----------------------------------------------------------------------------------------
 	/**
 	 * load by id
 	 * 
 	 * 
 	 */
 	 function load()
 	 {
 	 	if($mID)
 	 	{
 	 		return array();	
 	 	}
 	 	
 	 	$query = $this->db->get_where('lib_manager',array('id'=>$mID));
 	 	
 	 	if($row = $query->row_array())
 	 	{
 	 		return $row;
 	 	}
 	 	
 	 	return array(); 	 	
 	 }
 	 
 	 //-------------------------------------------------------------------------------------------
 	 /**
 	  * 创建用户
 	  * 
 	  * 
 	  */
 	  function create()
 	  {
 	  	$datetime = date('Y-m-d H:i:s');
 	  	$this->db->set('Mname',$this->name);
 	  	$this->db->set('Memail',$this->email);
 	  	$this->db->set('Mpass',md5($this->password));
 	  	$this->db->set('PowerLevel',$this->PowerLevel);
 	  	$this->db->set('CreateDate',$datetime);
 	  	$this->db->set('UpdateDate',$datetime);
 	  	
 	  	return $this->db->insert('lib_manager');
 	  }
 	  
 	  //-----------------------------------------------------------------------------------------------------
 	  /**
 	   * 结果集(对于不同等级的用户有不同的操作，暂时不实现)
 	   * 
 	   * 
 	   
 	   function find_admin_users()
 	   {
 	   	 $query = $this->db->get('lib_manager');
 	   	 $rows = array();	
 	   	 foreach($query->result_array() as $row)
 	   	 {
 	   	 	//角色
 	   	 	$query1 = $this->db->get_where('role',array('mID'=>$row['mID']));
 	   	 	$row1 = $query1->row_array();
 	   	 	if(!empty($row1))
 	   	 	{
 	   	 		$row['role_name'] = $row1['name'];
 	   	 	}
 	   	 	esle
 	   	 	{
 	   	 		$row['role_name'] = '';
 	   	 	}
 	   	 	$rows[$row['id']] = $row;
 	   	 }
 	   	 return $rows; 	   	    		
 	   }
 	   
 	   //---------------------------------------------------------------------------------------------------
 	   */
 	   /**
 	    * 更新
 	    *
 	    *
 	    */
 	    function update($id)
 	    {
 	    	$datetime = date('Y-m-d H:i:s');
 	    	$this->db->set('Mname',$this->name);
 	    	//$this->db->set('Mpass',$this->password);
 	    	$this->db->set('Memail',$this->email);
 	    	if($this->password)
 	    	{
 	    		$this->db->set('Mpass',md5($this->password));
 	    	}
 	    	$this->db->set('PowerLevel',$this->PowerLevel);
 	    	$this->db->set('UpdateDate',$datetime);
 	    	return $this->db->update('lib_manager');
 	    }
 	    
 	    //----------------------------------------------------------------------------------------------------
 	    /**
 	     * 总数
 	     * 
 	     * 
 	     */
 	     function total_rows()
 	     {
 	     	return $this->db->count_all_results('lib_manager');
 	     }
 	    
 	    //--------------------------------------------------------------------------------------------------
 	    /**
 	     * 删除
 	     * 
 	     * 
 	     */
 	     function delete($id)
 	     {
 	     	$this->db->where('mID',$id);
 	     	return $this->db->delete('lib_manager');
 	     }
 	     
 	     //--------------------------------------------------------------------------------------------------
 	     /**
 	      *登陆后获得操作权限
 	      *
 	      *
 	      */
 	      function signin()
 	      {
 	      	$query = $this->db->get_where('lib_manager',array('Mname'=>$this->name,'Mpass'=>md5($this->password)));
 	      	//认证通过
 	      	if($row = $query->row_array())
 	      	{
 	      		//角色这里的id和manager中的PowerLevel是一个
 	      		$query1 = $this->db->get_where('lib_role',array('id'=>$row[PowerLevel]));
 	      		//将该角色的所有操作放在row1中
 	      		$row1 = $query1->row_array();
 	      		if(!empty($row1))
 	      		{
 	      			$row['action_list'] = $row1['action_list'];
 	      		}
 	      		else
 	      		{
 	      			$row['action_list'] = '';
 	      		}
 	      		return $row;
 	      	}
 	      	return array();
 	      }
 	      
 	      //---------------------------------------------------------------------------------------------
 	      /**
 	       *获取用户角色
 	       *
 	       *
 	       */
 	      function role_user($role_id)
 	      {
 	      	if(!$role_id)
 	      	{
 	      		return array();
 	      	}
 	      	
 	      	$query = $this->db->get_where('lib_manager',array('mID'=>$role_id));
 	      	
 	      	if($row = $query->row_array())
 	      	{
 	      		return $row;
 	      	} 	      	
 	      	return array(); 	      	
 	      }	      
 	      
 }
?>






















