<?php
/*图书
 * Created on 2012-9-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 *
 */
 class Books_model extends CI_Model
 {
 	var $bookID;   //书本ID
 	
 	var $barcode;    //条形码
 	
 	var $bookname;    //书名
 	
 	var $booktype;     //类型（叶类型）
 	
 	var $author;    //作者
 	
 	var $translator;     //翻译者
 	
 	var $ISBN;       //出版社编号
 	
 	var $price;         //价格
 	
 	var $page;         //页数
 	
 	var $keywords;     //关键字
 	
 	var $bookrack;    //书架号
 	
 	var $storge ;  //库存
 	
 	var $publishtime;
 	
 	var $inTime ; //入库时间
 	
 	var $isdelete;   //是否被删除了
 	
 	var $UpdateDate;
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->database();
 	}
 	
 	//------------------------------------------------------------------------------------------------------------
 	/**
 	 * load by id
 	 * 
 	 * 
 	 */
 	function load($id)
 	{
 		if(!$id)
 		{
 			return array();
 		}
 		//的到书籍信息
 		$query = $this->db->get_where('lib_bookinfo',array('bookID'=>$id)); 		
 		
 		if($row = $query->row_array())
 		{
 			//分类信息
 			$query1 = $this->db->get_where('lib_books_cat',array('id'=>$row['booktype']));	
 			//还要找到各个等级,暂时返回叶等级
 			$row1 = $query1->row_array();
 			
 			if(!empty($rows))
 			{
 				$row['type'] = $row1;
 			}
 			else
 			{
 				$row['type'] = array();
 			}
 			
 			//内容
 			$query2 = $this->db->get_where('lib_book_content',array('id'=>$row['barcode']));
 			$row2 = $query->result_array(); 
 			
 			return $row;		
 		} 		
 		return array();
 	}
 	
 	//-----------------------------------------------------------------------------------------------------------
 	/**
 	 * 添加
 	 * 
 	 * 
 	 */
 	 function add()
 	 {
 	 	$datetime = date('Y-m-d H:i:s');
 	 	$this->db->set('barcode',$this->barcode);
 	 	$this->db->set('bookname',$this->bookname);
 	 	$this->db->set('booktype',$this->booktype);
 	 	$this->db->set('author',$this->author);
 	 	$this->db->set('translator',$this->translator);
 	 	$this->db->set('ISBN',$this->ISBN);
 	 	$this->db->set('price',$this->price);
 	 	$this->db->set('page',$this->page);
 	 	$this->db->set('keywords',$this->keywords);
 	 	$this->db->set('bookrack',$this->bookrack);
 	 	$this->db->set('storge',$this->storge);
 	 	$this->db->set('publishtime',$this->publishtime);
 	 	$this->db->set('inTime',$datetime);
 	 	$this->db->set('isdelete','0');
 	 	//if($UpdateDate)
 	 	//{
 	 		//$this->db->set('UpdateDate',$UpdateDate);
 	 	//}
 	 	
 	 	return $this->db->insert('lib_bookinfo'); 	 	
 	 }
 	 
 	
 	 
 	 //-----------------------------------------------------------------------------------------------------------
 	 /**
 	  * 更新
 	  * 
 	  * 
 	  */
 	  function update($id)
 	 {
 	 	$datetime = date('Y-m-d H:i:s');
 	 	//$this->db->set('barcode',$this->barcode);
 	 	$this->db->set('bookname',$this->bookname);
 	 	$this->db->set('booktype',$this->booktype);
 	 	$this->db->set('author',$this->author);
 	 	$this->db->set('translator',$this->translator);
 	 	$this->db->set('ISBN',$this->ISBN);
 	 	$this->db->set('price',$this->price);
 	 	$this->db->set('page',$this->page);
 	 	$this->db->set('keywords',$this->keywords);
 	 	$this->db->set('bookrack',$this->bookrack);
 	 	$this->db->set('storge',$this->storge);
 	 	$this->db->set('publishtime',$this->publishtime);
 	 	$this->db->set('UpdateDate',$datetime);
 	 	//$this->db->set('isdelete','0');
 	 	$this->db->where('bookID',$id);
 	 	return $this->db->update('lib_bookinfo'); 	 	
 	 }
 	 
 	 //--------------------------------------------------------------------------------------------------------------
 	 /**
 	  * 删除
 	  * 
 	  * 
 	  */
 	  function delete($id)
 	  {
 	  		  	
 	  	return $this->db->delete('lib_bookinfo',array('bookID'=>$id));
 	  	
 	  }
 	  
 	  //--------------------------------------------------------------------------------------------------------------
 	 /**
 	  * 放入 回收站
 	  * 
 	  * 
 	  */
 	  function in_recycle($id)
 	  {
 	  	
 	  	
 	  	$this->db->where('bookID',$id);
 	  	//$this->db->delete('lib_bookinfo');这里做的不是将内容删除而是将删除标志置为1
 	  	$this->db->set('isdelete',1);
 	  	$this->db->update('lib_bookinfo');
 	  }
 	  
 	  
 	   	
 	   	//-------------------------------------------------------------------------------------------------
 	   	/**
 	   	 * 查找图书 
 	   	 * 
 	   	 * 
 	   	 */	   	
 	   	
 	   function find_books($options = array(),$count=20, $offset=0, $is_delete=0)	
 	   {
 	   		if(!is_array($options))
 	   	 	{
 	   	 		////echo '没有设置查询规则books_model line 229';
 	   	 		return array();
 	   	 	}
 	   	 	if ($count)
 	   	 	{
            	//$this->db->limit((int)$count, (int)$offset);
            	$limit = "limit $offset , $count";
        	}
        	//没有图书类型，只有查询方式和相应关键字
        	if($options['booktype'] == '')
        	{
        		//查询方式不为空且关键字不为空
        		if($options['selecttype']!='' && $options['keywords'] != '')
        		{
        			//////echo '221';
	        		$selecttype = $options['selecttype'];
	        		$keywords = $options['keywords'];
	        		$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete ='$is_delete'".$limit;
	        	}
	        	//输入关键字但是没选择查询方式，则选择默认查询方式（bookname）
	        	else if($options['selecttype']=='' && $options['keywords'] != '')
	        	{
	        		//////echo '229';
	        		$selecttype = 'bookname';
	        		$keywords = $options['keywords'];
	        		$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete ='$is_delete'".$limit;
	        	}
	        	//关键字和查询类型都为空
	        	else if($options['selecttype']=='' && $options['keywords'] == '')
	        	{
	        		//////echo '237';
	        		$sql = "select * from lib_bookinfo where isdelete ='$is_delete'".$limit;
	        	}	        	
	        	else
	        	{
	        		echo '查询条件错误 line 240';
	        	}
        			
        		
        	}
        	//有查询图书类型（分为只有图书类型和图书类型+关键字）
        	else if($options['booktype']!=='')
        	{
        		//////echo "booktype:".$options['booktype'];
        		$booktype = $options['booktype'];
        		//图书类型+关键字类型+关键字
        		if($options['selecttype']!='' && $options['keywords']!='' )
        		{
        			//////echo '255';
        			$selecttype = $options['selecttype'];
        			$keywords = $options['keywords'];
        			$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete = '$is_delete' and booktype = '$booktype'".$limit;
        	
        		}
        		//图书类型+关键字类型+关键字为空
        		elseif($options['selecttype']!='' && $options['keywords']=='' )
        		{
        			////echo '264';
        			$selecttype = $options['selecttype'];
        			$keywords = $options['keywords'];
        			$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete = '$is_delete' ".$limit;
        	
        		}
        		//只有图书类型
        		elseif($options['selecttype']== '' && $options['keywords']=='' )
        		{
        			//echo '273';
        			$sql = "select * from lib_bookinfo where isdelete = '$is_delete' and booktype = '$booktype'".$limit;
        		}
        		else
	        	{
	        		echo '查询条件错误 line 278';
	        	}
        	}
        	
        	
        	//echo $sql;
        	$query = $this->db->query($sql);
        	$rows = array();
        	//print_r($query);
        	//$temp = $query->result_array();
        	//print_r($temp);
        	
        	if($query)
        	{        		
        		//开始匹配全部信息
        		foreach($query->result_array() as $row)
        		{
        			//echo "<br/>line 296 row:  ";
	        		//print_r($row);
        			//echo "<br/>";
    	    		//查找图书类型
        			$query1 = $this->db->get_where('lib_books_cat',array('id'=>$row['booktype'])); 
        			//print_r($query1);  
        			//echo "275";   
      		  		$row1 = $query1->row_array();
        			if(!empty($row1))
        			{
        			//echo "278";
        			$row['booktypename'] = $row1['name'];
	        		}
	        		else
	        		{
	        			//echo "283";
	        			$row['booktypename'] = $row1['name'];
	        		}
	        		//查找图书出版社
	        		$query2 = $this->db->get_where('lib_publishing',array('ISBN'=>$row['ISBN']));
	        		$row2 = $query2->row_array();
	        		if(!empty($row2))
	        		{
	        			$row['publisher'] = $row2['ISBNname'];
	        		}
	        		else
	        		{
	        			$row['publisher'] = '';
	        		}
	        		$rows[$row['bookID']] = $row;
	        		//print_r($rows);        		
	        	}
	        	//echo "301";
	        	//print_r($rows);
	        	//$rows['sql'] = $sql;
	        	return $rows;  
        	}        	    	
 	   }
 	   
 	   
 	   
 	   
 	   
 	    
 	    //-----------------------------------------------------------------------------------------------------
 	    /**
 	     * 获得新添加的数据
 	     * 
 	     * 
 	     */
 	     function get_newly_one()
 	     {
 	     	$this->db->from('lib_bookinfo');
        	$this->db->order_by("bookID", "desc");
        	$this->db->limit('1');
        	$query =  $this->db->get();
        	return $query->row_array();
 	     }
 	     
 	     //------------------------------------------------------------------------------------------------------
 	    /**单纯为了统计总数而写的函数
 	     * 
 	     * 
 	     */ 
 	    function find_books_count($options = array() ,$is_delete=0)	
 	   {
 	   		if(!is_array($options))
 	   	 	{
 	   	 		//echo '没有设置查询规则books_model line 229';
 	   	 		return array();
 	   	 	}
 	   	 	
        	//没有图书类型，只有查询方式和相应关键字
        	if($options['booktype'] == '')
        	{
        		//查询方式不为空且关键字不为空
        		if($options['selecttype']!='' && $options['keywords'] != '')
        		{
        			//echo '369';
	        		$selecttype = $options['selecttype'];
	        		$keywords = $options['keywords'];
	        		$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete ='$is_delete'";
	        	}
	        	//输入关键字但是没选择查询方式，则选择默认查询方式（bookname）
	        	else if($options['selecttype']=='' && $options['keywords'] != '')
	        	{
	        		//echo '377';
	        		$selecttype = 'bookname';
	        		$keywords = $options['keywords'];
	        		$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete ='$is_delete'";
	        	}
	        	//关键字和查询类型都为空
	        	else if($options['selecttype']=='' && $options['keywords'] == '')
	        	{
	        		//echo '385';
	        		$sql = "select * from lib_bookinfo where isdelete ='$is_delete'";
	        	}	        	
	        	else
	        	{
	        		echo '查询条件错误 line 390';
	        	}
        			
        		
        	}
        	//有查询图书类型（分为只有图书类型和图书类型+关键字）
        	else if($options['booktype']!=='')
        	{
        		////echo "booktype:".$options['booktype'];
        		$booktype = $options['booktype'];
        		//图书类型+关键字类型+关键字
        		if($options['selecttype']!='' && $options['keywords']!='' )
        		{
        			//echo '403';
        			$selecttype = $options['selecttype'];
        			$keywords = $options['keywords'];
        			$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete = '$is_delete' and booktype = '$booktype'";
        	
        		}
        		//图书类型+关键字类型+关键字为空
        		elseif($options['selecttype']!='' && $options['keywords']=='' )
        		{
        			//echo '412';
        			$selecttype = $options['selecttype'];
        			$keywords = $options['keywords'];
        			$sql = "select * from lib_bookinfo where $selecttype = '$keywords' and isdelete = '$is_delete' ";
        	
        		}
        		//只有图书类型
        		elseif($options['selecttype']== '' && $options['keywords']=='' )
        		{
        			////echo '421';
        			$sql = "select * from lib_bookinfo where isdelete = '$is_delete' and booktype = '$booktype'";
        		}
        		else
	        	{
	        		echo '查询条件错误 line 426';
	        	}
        	}
        	
        	
        	$query = $this->db->query($sql);        	
        	return $query;        	
 	   }
 	       	      
 	      
 	      //-------------------------------------------------------------------------------------------------
 	      /**
 	       * 总数 
 	       * 
 	       * 
 	       */
 	       function count_books($options = array(),$is_delete=0)
 	       {
 	       	//SELECT COUNT(DISTINCT column_name) FROM table_name !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 	       	//$this->db->select('COUNT(DISTINCT(lib_bookinfo.bookID)) as total ');
 	       	$query = $this->find_books_count($options,$is_delete);
 	       	//print_r($query);
 	       	$total = $query->num_rows();
 	       	//////echo '<br/>total line 403 :'.$total.'<br/>';
 	       	/*if ($row = $query->row_array())
 	       	{
 	       		//print_r($row);
            	$total = (int)$row['total'];
        	}*/
        	
        	return $total;
 	       }
		   
 	       //---------------------------------------------
 	       /**
			 * 出回收站
			 *
			 *
	 		*/	
		   function out_recycle($id)
		   {
        		$this->db->set('isdelete', 0);
        		$this->db->where('bookID', $id);
        		return $this->db->update('lib_bookinfo');
		   }
		   
	// --------------------------------------------------------------------
    /**
	 * 查询某分类下是否有商品
	 *
	 *
	 */	
	function check_books_by_cat($booktype)
	{
		$this->db->select('bookID');
        $query = $this->db->get_where('lib_bookinfo',array('booktype' => $booktype));
		return $query->row_array();
	}
		  
 }
?>
