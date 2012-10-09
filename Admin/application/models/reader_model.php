<?php
/*
 * Created on 2012-9-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class Reader_model extends CI_Model
 {
 	//注册必须的信息
 	var $name; 	
 	var $password; 	
 	var $papercode; 	
 	var $papertype; 	
 	var $Email; 	
 	var $typeid; 	
 	
 	//一般信息
 	var $barcode;
 	var $sex;
 	var $age;
 	var $birthday;
 	var $telephone;
 	var $remark;
 	var $credit;
 	
 	function __construct()
 	{
 		parent::__construct(); 		
 	}
 	
 	//-------------------------------------------------------------------------------------------
 	/**
 	 * load by id
 	 * 
 	 */
 	 function load($id)
 	 {
 	 	if(!$id)
 	 	{
 	 		return array();
 	 	}
 	 	
 	 	$query = $this->db->get_where('lib_reader',array('id'=>$id));
 	 	
 	 	if($row = $query->row_array())
 	 	{
 	 		//return $row;
 	 		$type = $this->db->get_where('libreadertype',array('id'=>$row['typeid']));
 	 		$temp = $type->result_array();
 	 		$row['type_name'] = $temp['name'];
 	 		$row['numberofdays'] = $temp['numberofdays'];
 	 		
 	 		return $row;
 	 	}
 	 	else
 	 	{
 	 		return array();
 	 	}
 	 }
 	 
 	 //-------------------------------------------------------------------------------------
 	 /**
 	  * 创建用户
 	  * 
 	  */
 	  function create()
 	  {
 	  	$datetime = date('Y-m-d H:i:s');
 	  	
 	  	$this->db->set('name',$this->name);
 	  	$this->db->set('Email',$this->email);
 	  	$this->db->set('password',md5($this->password));
 	  	$this->db->set('typeid',$this->typeid);
 	  	$this->db->set('papertype',$this->papertype);
 	  	$this->db->set('papercode',$this->papercode); 	  	
 	  	$this->db->set('CreateDate',$datetime);
 	  	
 	  	$this->db->insert('lib_reader'); 	  	
 	  }
 	  
 	  //----------------------------------------------------------------------------------------
 	  /**
 	   * 结果集
 	   * 
 	   */
 	   function find_all_readers()
 	   {
 	   		$query = $this->db->get('lib_reader');
 	   		$rows = array();
 	   		
 	   		foreach($query->result_array() as $row)
 	   		{
 	   			$query1 = $this->db->get_where('lib_readertype',array('id'=>$row['typeid']));
 	   			$row1 = $query1->row_array();
 	   			if(!empty($row1))
 	   			{
 	   				$row['type_name'] = $row1['name'];
 	   				$row['numberofdays'] = $row1['numberofdays'];
 	   			}
 	   			else
 	   			{
 	   				$row['type_name'] = 0;
 	   				$row['numberofdays'] = 0;
 	   			}
 	   			
 	   			$rows[$row['id']] = $row;
 	   		}
 	   }
 	   
 	   //--------------------------------------------------------------------------------------
 	   /**
 	    * 更新
 	    * 
 	    */
 	    function update($id)
 	    {
 	    	$datetime = date('Y-m-d H:i:s');
 	  	
	 	  	$this->db->set('name',$this->name);
	 	  	$this->db->set('Email',$this->email);
	 	  	if($this->password)
	 	  	{
	 	  		$this->db->set('password',md5($this->password));
	 	  	}	 	  	
	 	  	$this->db->set('typeid',$this->typeid);
	 	  	$this->db->set('papertype',$this->papertype);
	 	  	$this->db->set('papercode',$this->papercode); 	  	
	 	  	$this->db->set('UpdateDate',$datetime);	 	  
	 	  	
	 	  	$this->db->set('barcode',$this->barcode);
	 	  	$this->db->set('sex',$this->sex);
	 	  	$this->db->set('age',$this->age);
	 	  	$this->db->set('birthday',$this->birthday);
	 	  	$this->db->set('teltphone',$this->telephone);
	 	  	$this->db->set('remark',$this->remark);
	 	  	$this->db->set('credit',$this->credit);
	 	  	
	 	  	$this->db->where('id',$id);
	 	  	return $this->db->update('lib_reader'); 	  	
 	    }
 	    
 	    //-------------------------------------------------------------------------------------
 	    /**
 	     *总数 
 	     * 
 	     */
 	     function total_reader()
 	     {
 	     	return $this->db->count_all_results('lib_reader');
 	     }
 	     
 	     //--------------------------------------------------------------------------------------
 	     /**
 	      * 删除
 	      * 
 	      */
 	      function delete($id)
 	      {
 	      	$this->db->where('id',$id);
 	      	return $this->db->delete('lib_reader');
 	      }
 	      
 	      //----------------------------------------------------------------------------------------
 	      /**
 	       * get newly one
 	       * 
 	       */
 	       function get_newly_one()
 	       {
 	       		$this->db->from('lib_reader');
 	       		$this->db->order_by('id','desc');
 	       		$this->db->limit('1');
 	       		$query = $this->db->get();
 	       		
 	       		return $query->result_array(); 	       		
 	       }
 	       
 	       //--------------------------------------------------------------------------------
 	       /**
 	        * 根据用户名找到用户
 	        * 
 	        */
 	        function find_reader_by_name($name)
 	        {
 	        	if(!$name)
		 	 	{
		 	 		return array();
		 	 	}		 	 	
		 	 	$query = $this->db->get_where('lib_reader',array('name'=>$name));
		 	 	
		 	 	if($row = $query->row_array())
		 	 	{
		 	 		//return $row;
		 	 		$type = $this->db->get_where('libreadertype',array('id'=>$row['typeid']));
		 	 		$temp = $type->result_array();
		 	 		$row['type_name'] = $temp['name'];
		 	 		$row['numberofdays'] = $temp['numberofdays'];
		 	 		
		 	 		return $row;
		 	 	}
		 	 	else
		 	 	{
		 	 		return array();
		 	 	}
 	        }
 	        
 	        //--------------------------
 	        /**
 	         * search
 	         * 
 	         */
 	         function find_reader($options = array(),$count = 20,$offset = 0)
 	         {
 	         	
 	         }
 	
 }
?>











