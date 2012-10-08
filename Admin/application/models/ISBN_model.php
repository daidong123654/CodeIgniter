<?php
/*
 * Created on 2012-10-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class ISBN_model extends CI_Model
 {
 	var $id;
 	
 	var $ISBN;
 	
 	var $ISBNname;
 	
 	var $Email;
 	
 	var $phone;
 	
 	var $created_at;	
 	
 	function __construct()
 	{
 		parent::__construct();
 	}		
 	
 	//------------------------------------------------------------------------------------------
 	/**
 	 * find ISBNS  将来再写吧，类似于books的分页查找
 	 * 
 	 */
 	function find_ISBN()
 	{
 		
 	}
 	
 	//--------------------------------------------------------------------------------------------
 	/**
 	 * 结果集
 	 * 
 	 */
 	function find_all_ISBN()
	{
		$this->db->from('lib_publishing');        		
	   
        $query = $this->db->get();
       // print_r($query);
        $rows = array();
        foreach ($query->result_array() as $row)
        {   
        	$this->db->select('COUNT(DISTINCT(bookID)) as total');
        	$query_pro = $this->db->get_where('lib_bookinfo',array('ISBN' => $row['ISBN']));
            $row['booknum'] = 0;
            if ($row_pro = $query_pro->row_array())
            {
                $row['booknum'] = (int)$row_pro['total'];
            }        
            $rows[$row['id']] = $row;
        }
        //print_r($rows);
        return $rows;
	}
	
	//---------------------------------------------------------------------------------------
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
	 	$query = $this->db->get_where('lib_publishing',array('id'=>$id));
	 	$row = array();
	 	foreach ($query->result_array() as $row)
        {   
        	$this->db->select('COUNT(DISTINCT(bookID)) as total');
        	$query_pro = $this->db->get_where('lib_bookinfo',array('ISBN' => $row['ISBN']));
            $row['booknum'] = 0;
            if ($row_pro = $query_pro->row_array())
            {
                $row['booknum'] = (int)$row_pro['total'];
            }
        }
        return $row;	 	
	 }
	
	
	//-----------------------------------------------------------------------------------------
	/**
	 * 增加
	 * 
	 */
	 function create()
	 {
	 	$datetime = date('Y-m-d H:i:s');
	 	$this->db->set('ISBN',$this->ISBN);
	 	$this->db->set('ISBNname',$this->ISBNname);
	 	$this->db->set('Email',$this->Email);
	 	$this->db->set('phone',$this->pnone);
	 	$this->db->set('created_at',$this->created_at);
	 	
	 	$this->db->insert('lib_publishing');
	 }
	 
	 //-------------------------------------------------------------------------------------------
	 /**
	  * 删除
	  * 
	  */
	  function delete($id)
	  {
	  	 //$this->db->where('id',$id);
	  	 $this->db->delete('lib_publishing',array('id'=>$id));	  	 
	  }
	  
	  //------------------------------------------------------------------------------------------
	  /**
	   * update
	   * 
	   */
	   function update($id)
	   {
	   		
		 	$this->db->set('ISBN',$this->ISBN);
		 	$this->db->set('ISBNname',$this->ISBNname);
		 	$this->db->set('Email',$this->Email);
		 	$this->db->set('phone',$this->pnone); 	
		 	
		 	$this->db->where('id',$id);
		 	$this->db->update('lib_publishing');
	   }
	   
	   //------------------------------------------------------------------------------------------------
	   /**
	    * get newly one
	    * 
	    * 
	    */
	    function get_newly_one()
	    {
	    	$this->db->from('lib_publishing');
	    	$this->db->order_by('id','desc');
	    	$this->db->limit('1');
	    	$query = $this->db->get();
	    	return $query->result_array();
	    }
	    
	    
	    
 }
?>
