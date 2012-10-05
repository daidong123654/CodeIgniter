<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Created on 2012-9-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class Books extends CI_Controller
 {
 	/**
 	 * 构造函数
 	 * 
 	 * 登陆检验
 	 */
 	function __construct()
 	{
 		parent::__construct();
 		if(!$this->session->userdata('logged_in'))
 		{
 			redirect('login');
 			exit();
 		}
 	}
 	
 	//-------------------------------------------------------------------------------------------------------------------
 	/*
 	 * 图书列表
 	 * 
 	 */
 	 function index()
 	 {
 	 	//echo "books.php"; 	
 	 	//echo   $this->input->post('keywords');
 	 	
 	 	$keywords= ($this->input->post('keywords') ) ? ($this->input->post('keywords')) : 0;     //查询值  
 	 	$types= ($this->input->post('booktype')) ? ($this->input->post('booktype')) : 0;
 	 	$selecttype = ($this->input->post('selecttype') ) ? ($this->input->post('selecttype')) : 0;     //用来存放查询方式（对应表中的属性名） 
 	 	$search = $this->input->post('search');    //通过search将数据查询分为搜索和分页查询
 	 	$page = $this->input->post('page');
 	   	$page = (int) $page; 	   
 	   	
 	    
 	    //调试使用
 	    /*if(empty($keywords) || empty($types) || empty($selecttype) || empty($search) || empty($page))
 	    {
 	    	$keywords= 'daidong';     //查询值    
 	 		$types= 1;
 	 		$selecttype = 'bookname';     //用来存放查询方式（对应表中的属性名） 
 	 		$search = 1;    //通过search将数据查询分为搜索和分页查询
 	 	 	    
 	    	$page = 1;
 	    }
 	    */
 	    
 	    
 	    
 	   //分页+查询url设置
 	   $segments = $this->uri->uri_to_assoc();
 	  // print_r($segments);
 	   if($search)
 	   {
 	   		$segments['types'] = $types;  //书的类别
 	   		$segments['selecttype'] = $selecttype;
 	   		$segments['keywords']  = $keywords; 	   		 
 	   }
 	   else
 	   {
 	   		$segments['types'] = !empty($segments['booktype']) ? $segments['booktype'] : '';
 	   		$segments['selecttype'] = !empty($segments['selecttype']) ? $segments['selecttype'] : ''; 	   		
 	   		$segments['keywords'] = !empty($segments['keywords']) ? $segments['keywords'] : '';
 	   		//echo "  67  : ".$segments['keywords'];
 	   }
 	   
 	   //print_r($segments); 	   
 	   
 	   //现在只能实现类别+关键字查询
 	   $search_url = '/booktype/'.$segments['types'].'/'.$segments['selecttype'].'/'.$segments['keywords'];
 	   //计算查询条件
 	   //$options = array('conditions' => null);
 	   
 	   //处理查询条件options
 	   
 	   //按照分类查询(只有分类和分类关键字都有)
 	   if(!empty($segments['types']))
 	   {
 	   		$options['booktype'] = $segments['types'];
 	   		//echo '87';
 	   		//带有关键字查询
 	   		if(!empty($segments['selecttype']))
 	   		{
 	   			$options['selecttype'] = $segments['selecttype'];
 	   			$options['keywords'] = $segments['keywords'];	
 	   		}
 	   		//不带有关键字查询
 	   		else if(empty($segments['selecttype']))
 	   		{
 	   			$options['selecttype'] = 'bookname';
 	   			$options['keywords'] = '';
 	   		}
 	   		else
 	   		{
 	   			echo "查询条件错误！books.php line 85";
 	   		}
 	   		//echo "line 98";
 	   		//print_r($options); 	   		
 	   }
 	   //只按照关键字查询
 	   else
 	   {
 	   		$options['booktype'] = '';
 	   		//带有关键字查询
 	   		if(!empty($segments['selecttype']))
 	   		{
 	   			$options['selecttype'] = $segments['selecttype'];
 	   			$options['keywords'] = $segments['keywords'];	
 	   		}
 	   		else if(empty($segments['selecttype']))
 	   		{
 	   			//echo "查询条件为空！books.php line 114";
 	   			$options['selecttype'] = '';
 	   			$options['keywords'] = '';
 	   		}	   		
 	   }
 	   //print_r($options);
 	   
 	   //调试使用
 	   $data['temp'] =array(
				'keywords'=>  $options['keywords'],	 	
	 	 	 	'booktype'=>  $options['booktype'],	 
	 	 	 	'selecttype' => $options['selecttype'],
	 	 	 	'search'=> $this->input->post('search'), 	  
	 	     	'page'=> $page    	
	 	     ) ;
 	   $data['options'] = $options;
 	   
 	   $data['cat_selected'] = $segments['types'];
 	   $data['keywords'] = $segments['keywords'];
 	   $data['selecttype'] = $segments['selecttype'] ;
 	   
 	   
 	   //分页开始的数据行:$page_offset
 	   if($page)
 	   {
 	   		$page_offset = $page -1;
 	   }
 	   else if(!empty($segments['page']))
 	   {
 	   		$page_offset = (int) $segments['page'];
 	   }
 	   else
 	   {
 	   		$page_offset = 0;
 	   }
 	   if($page_offset < 0)
 	   {
 	   		$page_offset = 0;
 	   }
 	   
 	   //分页url
 	   $base_url = site_url('books/index/page').'/';
 	   
 	   //每页显示条数
 	   $per_page = 15;
 	   
 	   //数据总数
 	   $this->load->model('books_model');
 	   $data['total_rows'] = $this->books_model->count_books($options);
 	   
 	   //总页数 
 	   $data['total_pages'] = ceil($data['total_rows'] / $per_page);
 	   
 	   //当前页(input) 
 	   $data['page'] = $page_offset+1;
 	   $data['page'] = ($data['page'] > $data['total_rows'] && $data['total_pages'] >0) ? $data['total_rows'] : $data['page'];
 	   
 	   //第一页   最后一页   前一页   后一页   
 	   $data['page_first'] = $base_url.'0'.$search_url;
 	   $data['page_last'] = $base_url.($data['page'] - 1).$search_url;
 	   $data['page_prev'] = ($data['page'] > 1) ? $base_url.($data['page' - 2]).$search_url : $data['page_first'];
 	   $data['page_next'] = ($data['page'] < $data['total_pages']) ? $base_url.($data['page']).$search_url : $data['page_last'];
 	   
 	   //当前页  
 	   $data['cur_page'] = $base_url.($data['page'] - 1).$search_url;
 	   
 	   //当前页起始数据号码
 	   $data['show_start'] = ($data['page'] - 1)*$per_page +1;
 	   
 	   // 分类结果集，用于按分类筛选商品
        $this->load->model('category_model');			
	    $data['categorys'] = $this->category_model->find_all_categorys();
 	   
 	   //当前页结束数据号
 	   $data['show_end'] = ($page_offset < $data['total_pages'] - 1) ? ($data['show_start'] + $per_page - 1) : $data['total_rows'];
 	   
 	   //图书结果集 
 	   $data['books'] = $this->books_model->find_books($options,$per_page,($data['page'] - 1)*$per_page);
 	   
 	   // ajax 
 	   if(!empty($segments['ajax']) || $search == 2)
 	   {
 	   		$this->load->view('books/ajax_list',$data);
 	   }
 	   // 非 ajax
 	   else
 	   { 	  
 	   			
 	   		$this->load->view('books/books_list',$data); 	   		
	 	 	
 	   }
 	   
 	 }
 	 
 } 
 
?>
