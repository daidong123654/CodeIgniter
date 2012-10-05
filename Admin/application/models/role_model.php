<?php
/*角色
 * Created on 2012-9-27
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Role_model extends CI_Model
 {
 	var $name;
 	
 	var $action_list;
 	
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 		
 	}
 	
	//----------------------------------------------------------------------------------------------------------
 	/**
 	 * load by id
 	 * 
 	 * 
 	 */
 	 function load($id)
 	 {
 	 	if(!$id)
 	 	{
 	 		//echo "46";
 	 		return array();
 	 	}
 	 	
 	 	$query = $this->db->get_where('lib_role',array('id'=>$id));
 	 	
 	 	if($row = $query->row_array())
 	 	{
 	 		//echo "54";
 	 		//print_r($row);
 	 		return $row;
 	 	}
 	 	
 	 	return array();
 	 }
 	 
 	 //-----------------------------------------------------------------------------------------------------------
 	 /**
 	  * 创建
 	  * 
 	  * 
 	  * 
 	  */
 	  function create()
 	  {
 	  	$datetime = date('Y-m-d H:i:s');
 	  	$this->db->set('name',$this->name);
 	  	$this->db->set('action_list',$this->action_list);
 	  	//echo $this->action_list;
 	  	$this->db->set('created_at',$datetime);
 	  	$this->db->set('updated_at',$datetime);
 	  	
 	  	return $this->db->insert('lib_role');
 	  }
 	  
 	  //-----------------------------------------------------------------------------------------------------------
 	  /**
 	   * 结果集
 	   * 将role中所有的信息显示出来
 	   * 
 	   */
 	   function find_roles()
 	   {
 	   	$query = $this->db->get('lib_role');
 	   	$rows = array();
 	   	foreach ($query->result_array() as $row)  
 	   	{
 	   		$rows[$row['id']] = $row;
 	   		//print_r($row);
 	   	}
 	   	//print_r($rows);
 	   	return $rows;   //rows中的第id项row['id']项是表中id等于角标id的所有信息
 	   }
 	   
 	   //---------------------------------------------------------------------------------------------------------------
 	   /**
 	    * 更新
 	    * 
 	    * 
 	    */
 	    function update($id)
 	    {
 	    	$datetime = date('Y-m-d H:i:s');
 	    	$this->db->set('name',$this->name);
 	    	$this->db->set('action_list',$this->action_list);
 	    	$this->db->set('updated_at',$datetime);
 	    	
 	    	$this->db->where('id',$id);
 	    	$this->db->update('lib_role');
 	    }
 	    
 	    //--------------------------------------------------------------------------------------------------------------
 	    /**
 	     * 总数
 	     * 
 	     * 
 	     * 
 	     */
 	     function total_rows()
 	     {
 	     	return $this->db->count_all_results('lib_role');
 	     }
 	     
 	     //-------------------------------------------------------------------------------------------------------------
 	     /**
 	      * 删除
 	      * 
 	      * 
 	      * 
 	      */
 	      function delete($id)
 	      {
 	      	$this->db->where('id',$id);
 	      	
 	      	return $this->db->delete('lib_role');
 	      }
 	      
 	      //--------------------------------------------------------------------------------------------------------------
 	      /**
 	       * 获得新添加的数据
 	       * 
 	       * 
 	       */
 	       function get_newly_one()
 	       {
 	       	$this->db->form('lib_role');
 	       	$this->db->order_by('id','desc');
 	       	$this->db->limit('1');
 	       	$query = $this->db->get();
 	       	return $query->row_array();
 	       }
 	
 }
 
?>












