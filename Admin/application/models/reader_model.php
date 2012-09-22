<?php
/*
 * Created on 2012-9-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class Reader_model extends CI_Model
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();	//连接数据库
 	}
 	
 	
 	function MReaderRedister($ReaderRegisterinfo)
 	{
 		$this->db->insert('lib_reader',$ReaderRegisterinfo);
 		return true;
 	}
 	
 	function MReaderUpdate($ReaderId,$NewReaderinfo)
 	{
 		$this->db->where("readerid",$ReaderId);// 按照id索引来修改
 		$this->db->update("lib_reader",$NewReaderinfo);  		
		$this->load->model("Reader_model");	
		
		
 	}
 	function MReaderDelete($ReaderId)
 	{
 		
 		$this->db->where("readerid",$ReaderId);
 		$this->db->delete("lib_reader");
 	}
 	function MReaderSelect($readername)
 	{
 		$this->db->where("readername",$readername);
 		$this->db->select("*");
 		$query=$this->db->get("lib_reader");
 		return $query->row_array();
 	}
 	function MReaderSelectPapercode($papercode)
 	{
 		$this->db->where("papercode",$papercode);
 		$this->db->select("*");
 		$query=$this->db->get("lib_reader");
 		return $query->result();
 	}
 }
?>
