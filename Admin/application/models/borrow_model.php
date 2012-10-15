<?php
/*
 * Created on 2012-10-11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Borrow_model extends CI_Model
 {
 	var $bookID;
 	var $reader;
 	var $borrowtime;
 	var $returntime;
 	//var $isreturn;
 	
 	function __construct()
 	{
 		parent::__construct();
 	}
 	
 	//-----------------------------------------------------------------------------------------------
 	/**
 	 * create
 	 * 
 	 */
 	 function add()
 	 {
 	 	$datetime = date('Y-m-d H:i:s');
 	 	$this->borrowtime = $datetime;
 	 	//创建一个条目
 	 	$this->db->set('bookID',$this->bookID);
 	 	$this->db->set('reader',$this->reader);
 	 	$this->db->set('borrowtime',$this->borrowtime);
 	 	$this->db->set('isreturn','0');
 	 	$this->db->insert('lib_borrow');
 	 	/*
 	 	echo $this->bookID."<br>";
 	 	echo $this->reader."<br>";
 	 	echo $this->borrowtime."<br>";
 	 	*/
 	 	
 	 	//图书库存-1(判断在controller中进行) 	 	
 	 	$query = $this->db->get_where('lib_bookinfo',array('bookID'=>$this->bookID));
 	 	//print_r($query);
 	 	$row = array();
 	 	foreach($query->result_array() as $row)
 	 	{
 	 		$storge = $row['storge'];	
 	 	}
 	 	//echo $storge; 	 	
 	 	$this->db->set('storge',$storge-1);
 	 	$this->db->where('bookID',$this->bookID);
 	 	$this->db->update('lib_bookinfo');
 	 	
 	 	//读者借书+1
 	 	$query = $this->db->get_where('lib_reader',array('id'=>$this->reader));
 	 	foreach($query->result_array() as $row)
 	 	{
 	 		$BooksInBorrow = $row['BooksInBorrow'];	
 	 	}
 	 	$this->db->set('BooksInBorrow',$BooksInBorrow+1);
 	 	$this->db->where('id',$this->reader);
 	 	$this->db->update('lib_reader');		 	 	
 	 }
 	 
 	 //--------------------------------------------
 	 /**
 	  * return
 	  * 
 	  */
 	  function return_back($id)
 	  {
 	  	$datetime = date('Y-m-d H:i:s');
 	  	$query0 = $this->db->get_where('lib_borrow',array('id'=>$id));
 	 	//print_r($query0);
 	 	$row0 = array();
 	 	foreach($query0->result_array() as $row0)
 	 	{
 	 		
 	 	}
 	 	//print_r($row0);
 	  	$bookID = $row0['bookID'];
 	  	$reader = $row0['reader'];
 	  	
 	  	//set is_return 1
 	  	$flag = 0;
 	  	$this->db->set('isreturn','1');
 	  	$this->db->where('id',$id);
 	  	$this->db->set('returntime',$datetime);
 	  	if($this->db->update('lib_borrow'))
 	  		$flag++; 	  	
 	  	//图书库存+1(判断在controller中进行) 	 	
 	 	$query = $this->db->get_where('lib_bookinfo',array('bookID'=>$bookID));
 	 	//print_r($query);
 	 	$row = array();
 	 	foreach($query->result_array() as $row)
 	 	{
 	 		$storge = $row['storge'];
 	 	}
 	 	
 	 	//echo $storge; 	 	
 	 	$this->db->set('storge',$storge+1);
 	 	$this->db->where('bookID',$this->bookID);
 	 	if($this->db->update('lib_bookinfo'))
 	 		$flag++;
 	 	
 	 	//读者借书+1
 	 	$query = $this->db->get_where('lib_reader',array('id'=>$reader));
 	 	foreach($query->result_array() as $row)
 	 	{
 	 		$BooksInBorrow = $row['BooksInBorrow'];	
 	 	}
 	 	$this->db->set('BooksInBorrow',$BooksInBorrow-1);
 	 	$this->db->where('id',$this->reader);
 	 	if($this->db->update('lib_reader'))
 	 		$flag++;
 	 	if($flag==3)
 	 		return true;
 	 	else
 	 		return false;
 	 			 
 	  }
 	 
 	 //-------------------------------------------------------------------------
 	 /**
 	  * 结果集
 	  * 
 	  */
 	 
 	  function find( $count=20, $offset=0,$isreturn=0,$order='desc')
 	  {
 	  	//echo $count.'<br/>';
 	  	//echo $offset;
 	  	if($count)
 	  	{
 	  		$this->db->limit((int)$count, (int)$offset);
 	  	}
 	  	$this->db->order_by('borrowtime DESC');
 	  	
 	  	$this->db->where('isreturn',$isreturn); 	  	
 	  	$query = $this->db->get('lib_borrow'); 	  	
 	  	//print_r($query);
 	  	
 	  	
 	  	$rows = array(); 	  	
 	  	foreach($query->result_array() as $row)
 	  	{
 	  		////图书相关
 	  		//print_r($row); 	  		
 	  		$query1 = $this->db->get_where('lib_bookinfo',array('bookID'=>$row['bookID']));
 	  		$row1 = $query1->row_array();
 	  		//print_r($row1);
 	  		$row['bookname'] = $row1['bookname']; 	
 	  		$row['barcode'] = $row1['barcode'];
 	  		$row['price'] = $row1['price']; 	  		
 	  		//图书类型名
 	  		$query2 = $this->db->get_where('lib_books_cat',array('id'=>$row1['booktype']))  ;
 	  		//print_r($query2);	
 	  		$row2 = array();
 	  		foreach($query2->result_array() as $row2 )
 	  		{
 	  			//print_r($row2); 	  			
 	  		}
 	  		
 	  		$row['booktypename'] = $row2['name'];	
 	  		$row['bookAvail_days'] = $row2['Avail_days'];
 	  		
 	  		//读者相关
 	  		$query3 = $this->db->get_where('lib_reader',array('id'=>$row['reader'])); 
 	  		$row3 = $query3->row_array();
 	  		//print_r($row3);
 	  		$row['readername'] = $row3['name'];
 	  		$row['readerEmail'] = $row3['Email'];      //还可以将读者的其他信息放进去，为了安全就不放了
 	  		
 	  		//图书归还日期为空
 	  		if(empty($row['returntime']))
 	  		{
 	  			//$row['returntime'] = $row['borrowtime'] +  $row['bookAvail_days'];
 	  			//$row['returntime'] = date('Y-m-d',strtotime($row['borrowtime'])+30*60*60*30);
				$row['returntime'] = date ( ("Y-m-d"), mktime(0, 0, 0, date("m") , date("d")+$row['bookAvail_days']+1, date("Y")));
 	  		}
 	  		
 	  		$rows[$row['id']] = $row;
 	  	}
 	  	return $rows; 	  	  	
 	  }
 	  
 	  //------------------------------------
 	  /**
 	   * total rows
 	   */
 	   function total( $isreturn = '0')
 	  {
 	  	$this->db->where('isreturn',$isreturn);
 	  	$query = $this->db->get('lib_borrow'); 	  	
 	  	return $query->num_rows(); 	
 	  }
 	  
 	  //----------------------------------
 	  /**
 	   * newly one
 	   * 
 	   */
 	   function get_newly_one()
 	   {
 	   		$this->db->from('lib_borrow');
 	   		$this->db->order_by('id','desc');
 	   		$this->db->limit('1');
 	   		$query = $this->db->get();
 	   		return $query->row_array();
 	   }
 	
 }
?>
