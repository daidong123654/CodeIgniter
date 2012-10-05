<?php
/*权限
 * Created on 2012-9-27
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class admin_action_model extends CI_Model
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}
 	
 	//---------------------------------------------------------------------------------------------------------
 	/** 
 	 * 权限分组
 	 * 
 	 * 
 	 */
 	 function get_moduels()
 	 {
 	 	$query = $this->db->get_where('lib_admin_action',array('parent_id'=>0));
 	 	$rows = array();
 	 	
 	 	foreach ($query->result_array() as $row)
 	 	{
 	 		$rows[$row['id']] = $row;
 	 	}
 	 	return $rows;
 	 }
 	 
 	 //---------------------------------------------------------------------------------------------------------
 	 /**
 	  * 权限数据
 	  * 
 	  * 
 	  */
 	  function get_actions()
 	  {
 	  	$query = $this->db->get_where('lib_admin_action',array('parent_id !='=>0));
 	  	$rows = array();
 	 	
 	 	foreach ($query->result_array() as $row)
 	 	{
 	 		$rows[$row['id']] = $row;
 	 	}
 	 	return $rows;
 	  }
 }
?>










