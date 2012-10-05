<?php
/*
 * Created on 2012-10-4
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class category_model extends CI_Model
 {
 	var $name;
 	
 	var $parent_id;
 	
 	var $sort_order;
 	
 	var $_level;
 	
 	var $_path;
 	
 	var $_is_root;
 	
 	var $_is_leaf;
 	
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
        if (!$id){
            return array();
        }

        $query = $this->db->get_where('lib_books_cat',array('id' => $id));
        $row = array();
        $row = $query->row_array();    
		
		// 分类下的商品数
        $this->db->select('COUNT(DISTINCT(id)) as total');
		$query_pro = $this->db->get_where('lib_bookinfo',array('booktype' => $id));
		$row['pro_count'] = 0;
		if ($row_pro = $query_pro->row_array()){
			$row['pro_count'] = (int)$row_pro['total'];
		}

        return $row;
     }
     
     // ---------------------------------------------------------------------------------------------------
    /**
	 * 结果集
	 *
	 *
	 */	
	function find_all_categorys()
	{
		$this->db->from('lib_books_cat');
        		
	    $this->db->order_by('path','asc');		   

        $query = $this->db->get();
        $rows = array();
        foreach ($query->result_array() as $row){
			$this->db->select('COUNT(DISTINCT(id)) as total');
        	$query_pro = $this->db->get_where('lib_books_cat',array('id' => $row['id']));
            $row['pro_count'] = 0;
            if ($row_pro = $query_pro->row_array()){
                $row['pro_count'] = (int)$row_pro['total'];
            }
            $rows[$row['id']] = $row;
        }
        return $rows;
	}
 }
?>
