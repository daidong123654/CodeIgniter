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
 	 		$type = $this->db->get_where('lib_readertype',array('id'=>$row['typeid']));
 	 		$temp = $type->result_array();
 	 		//print_r($temp);
 	 		foreach($temp as $name => $value)
 	 		{
 	 			$row['type_name'] = $value['name'];
 	 			$row['numberofdays'] = $value['numberdays'];
 	 		}
 	 		
 	 		
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
 	  	$this->db->set('Email',$this->Email);
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
 	  
 	   function find_all_readers($count=20,$offset=0)
 	   {
 	   	
 	   		if($count)
 	   		{
 	   			$this->db->limit((int)$count,(int)$offset);
 	   		}
 	   		$this->db->where('isdelete','0'); 	   		
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
 	   		return $rows;
 	   } */
 	   
 	   function find_readers($options = array(), $count=20, $offset=0,$isdelete='0')
		{
			if (!is_array($options))
			{
	            return array();
	        }	
	        if ($count)
	        {
	            $this->db->limit((int)$count, (int)$offset);
	        }	          
	             	
	        $query = $this->_query_readers($options,$isdelete);	
	        $rows = array();
	        //print_r($rows);
	        foreach($query->result_array() as $row)
 	   		{
 	   			$query1 = $this->db->get_where('lib_readertype',array('id'=>$row['typeid']));
 	   			$row1 = $query1->row_array();
 	   			
 	   			if(!empty($row1))
 	   			{
 	   				$row['type_name'] = $row1['name'];
 	   				$row['numberofdays'] = $row1['numberdays'];
 	   			}
 	   			else
 	   			{
 	   				$row['type_name'] = 0;
 	   				$row['numberofdays'] = 0;
 	   			}
 	   			
 	   			$rows[$row['id']] = $row;
 	   		}
 	   		return $rows;
		}
		
		/**
		 * 私有函数
		 *
		 *
		 */
		function _query_readers($options = null,$isdelete)
	    {
	        $this->db->from('lib_reader');	        
	        $this->db->where('isdelete',$isdelete);	        
	        
			if (!empty($options['conditions']))
			{
	            $this->db->where($options['conditions']);
	        }
	        
	        if (isset($options['order']))
	        {
	            $this->db->order_by($options['order']);
	        } 
	        else
	        {
	            $this->db->order_by('id DESC');
	        }
	
	        return $this->db->get();
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
	 	  	$this->db->set('Email',$this->Email);
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
	 	  	$this->db->set('telephone',$this->telephone);
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
 	     function total_reader($options,$isdelete)
 	     {
 	     	//$this->db->where('isdelete','0');
 	     	$this->db->select('COUNT(DISTINCT(id)) as total');
 	     	$query = $this->_query_readers($options,$isdelete);
 	     	$total = 0;
	        if ($row = $query->row_array())
	        {
	            $total = (int)$row['total'];
	        }
 	     	return $total;
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
 	      
 	       //--------------------------------------------------------------------------------------
 	     /**
 	      * 回收
 	      * 
 	      */
 	      function in_recycle($id)
 	      {
 	      	$this->db->where('id',$id);
 	      	$this->db->set('isdelete','1');
 	      	return $this->db->update('lib_reader');
 	      }
 	      
 	       //--------------------------------------------------------------------------------------
	 	     /**
	 	      * 还原
	 	      * 
	 	      */
	 	      function out_recycle($id)
	 	      {
	 	      	$this->db->where('id',$id);
	 	      	$this->db->set('isdelete','0');
	 	      	return $this->db->update('lib_reader');
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
 	       
 	      
 	        
 	        //--------------------------
 	        /**
 	         * search
 	         * 
 	         
 	         function find_reader($keywords)
 	         {
 	         	if(!is_array($keywords))
 	         	{
 	         		return array();
 	         	} 	         	
 	         	$sql = "select * from lib_reader where name = '$keywords' or Email = '$keywords'";
 	         	$query = $this->db->query($sql);
 	         	$rows = array();
 	         	
 	         	if($query)
 	         	{
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
 	         		return $rows;
 	         	}
 	         	return $rows;
 	         }*/
 		
 		//-----------------------------------------------
 		/**
 		 * 找到读者借书书目
 		 * 
 		 */
 		 function find_borrow_books($id)
 		 {
 		 	$query = $this->db->get_where('lib_reader',array('id'=>$id));
 		 	$row = array();
 		 	foreach($query->result_array() as $row) 
 		 	{
 		 		//print_r($row);
 		 	}
 		 	if(!empty($row))
 		 	//echo $row['BooksInBorrow'];
 		 		return $row['BooksInBorrow'];
 		 	else 		 	
 		 		return null;
 		 }
 }
?>











