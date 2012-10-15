<?php
/*
 * Created on 2012-10-11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class borrow extends CI_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 	}
 	
 	function index()
 	{	    
 	    $page = $this->input->post('page');
 		$page = (int)$page;
 		
 		//分页显示url
 		$segments = $this->uri->uri_to_assoc();
 		$search_uri = ''; 		
 		
 		//分页查询数据
 		if($page)
 		{
            $page_offset = $page-1;
		}
		else if (!empty($segments['page']))
		{
            $page_offset = (int)$segments['page'];		
        } 
        else 
        {
            $page_offset = 0;
        }
		if ($page_offset<0)
		{
            $page_offset=0;
		}
 		
 		//分页url
 		$base_url = site_url('borrow/index/page').'/';
 		
 		//每页显示数据条数
 		$per_page = 3;
 		$data['per_page'] = $per_page;
 		
 		//数据总数
 		$this->load->model('borrow_model');
 		$data['total_rows'] = $this->borrow_model->total('0');
 		
 		$data['keywords'] = ($this->input->post('keywords')) ? $this->input->post('keywords') : '';
 		
 		//total pages
 		$data['total_pages'] = ceil($data['total_rows'] / $per_page);
 		
 		//当前页(input)
 		$data['page'] = $page_offset + 1;
 		$data['page'] = ($data['page']>$data['total_pages'] && $data['total_pages']>0) ? $data['total_pages'] : $data['page'];
 		
 		//first last prev next page
 		$data['page_first'] = $base_url.'0'.$search_uri;
		$data['page_last'] = $base_url.($data['total_pages']-1).$search_uri;
		$data['page_prev'] = ($data['page']>1) ? $base_url.($data['page']-2).$search_uri : $data['page_first'];
	    $data['page_next'] = ($data['page']<$data['total_pages']) ? $base_url.($data['page']).$search_uri : $data['page_last'];
 		
 		//当前页码
 		$data['cur_page'] = $base_url.($data['page'] - 1).$search_uri;
 		
 		//当前页起始数据号
 		$data['show_start'] = ($data['page'] - 1)*$per_page+1;
 		
 		//当前页结束数据号
 		$data['show_end'] = ($page_offset < $data['total_pages'] - 1) ? ($data['show_start'] + $per_page) : $data['total_rows'];
 		
 		//读者结果集
 		$data['borrows'] = $this->borrow_model->find($per_page,($data['page'] - 1)*$per_page); 		
 		
 		//print_r($data['readers']);
 		
 		// ajax
		if (!empty($segments['ajax']))
		{
			$this->load->view('borrow/ajax_list',$data);
		// 非 ajax
		}
		else
		{
            $this->load->view('borrow/list',$data);
		}
 		
 	}
 	
 	//------------------------------------------------------------------------------------------
 	/**
 	 * 借书 borrow
 	 * 
 	 */
 	function add()
 	{
 		//echo 'add'; 		
 		//该书还有多少
 		//$this->load->model('books_model');
 		//$storge = $this->books_model->find_books_storge($bookID);
 		//该读者借了几本书
 		//$this->load->model('reader_model');
 		//$BooksInBorrow = $this->reader_model->find_borrow_books($reader); 
 		if(!admin_priv('books_borrow'))	
 		{
 			return show_message2('您没有借阅图书的权利！','borrow');
 		}	 		
 		$this->load->view('borrow/borrow');
 	}
 	
 	//-----------------------------------------------
 	/**
 	 * save
 	 */
 	 function save()
 	 {
 	 	//echo "  22";
 	 	//var $bookID;
 		//var $reader;
 		//var $borrowtime;
 		//var $returntime;
 	 	$re_edit = $this->input->post('re_edit');
 	 	
 	 	//id
 	 	$bookID = $this->input->post('bookID');
 	 	$reader = $this->input->post('reader');
 	 	
 	 	//form 
 	 	$this->load->library('form_validation');
 	 	
 	 	//rules
 	 	$this->set_save_form_rules();
 	 	
 	 	//表单验证成功
 	 	if($this->form_validation->run() == true)
 	 	{
 	 		//剩余图数量,不能这样。因为图书馆是你拿到书之后到前台去借而不是在网上借书。
 	 		$this->load->model('books_model');
 	 		$left_books = $this->books_model->find_books_storge($bookID);	
 	 		if(!$left_books)
 	 		{
 	 			return show_message2('该图书'.$bookID.'不存在~~','borrow');
 	 		} 		
 	 		
 	 		//读者借书量（最多5本）
 	 		$this->load->model('reader_model');
 	 		$BooksInBorrow = $this->reader_model->find_borrow_books($reader);
 	 		if($BooksInBorrow=='')
 	 		{
 	 			return show_message2('该读者不存在~~','borrow');
 	 		}
 	 		
 	 		if($BooksInBorrow >= 5)
 	 		{
 	 			return show_message2('该读者已经有5本书再借未还，请还书之后再借阅~~','borrow');
 	 		}
 	 		
 	 		$this->load->model('borrow_model');
 	 		//提交表单到模型
 	 		$this->borrow_model->bookID = $bookID;
 	 		$this->borrow_model->reader = $reader;
 	 		
 	 		$this->borrow_model->add(); 		
 	 		
 	 		if($re_edit)
 	 		{
 	 			$newly_one  = $this->borrow_model->get_newly_one();
 	 			show_message('借阅(ID:'.$newly_one['id'].')已保存！','borow/add');
 	 		}
 	 		else
 	 		{
 	 			show_message2('借阅成功！','borrow');
 	 		}
 	 	}
 	 	
 	 	//表单验证失败
 	 	else
 	 	{
 	 		show_message2('表单验证失败，书号和读者号是必须的！','borrow');
 	 	}
 	 	
 	 }
 	 
 	 //--------------------------------------------
 	  /**
 	   * 表单验证规则
 	   * 
 	   */
 	   function set_save_form_rules()
 	   {
 	   		$rules['bookID'] = 'required|max_lenth[100]';
 	   		$rules['reader'] = 'required'; 	   		
 	   		
 	   		$this->form_validation->set_rules($rules);		
 	   } 
 	   
 	   //--------------------------------
 	   /**
 	    * return back
 	    */	  
 	    function return_back()
 	    {
 	    	$id = $this->uri->uri_to_assoc();
 	    	//print_r($id);
 	    	$this->load->model('borrow_model');
 	    	//echo $id['id'];
 	    	if($this->borrow_model->return_back($id['id']))
 	    	{
 	    		show_message2('归还成功！','borrow');
 	    	}
 	    	else
 	    	{
 	    		show_message2('归还失败！','borrow');
 	    	}
 	    	
 	    }
 	    
 	    //------------------
 	    /**
 	     * recycle
 	     */
 	     function recycle()
	 	{	    
	 	    $page = $this->input->post('page');
	 		$page = (int)$page;
	 		
	 		//分页显示url
	 		$segments = $this->uri->uri_to_assoc();
	 		$search_uri = ''; 		
	 		
	 		//分页查询数据
	 		if($page)
	 		{
	            $page_offset = $page-1;
			}
			else if (!empty($segments['page']))
			{
	            $page_offset = (int)$segments['page'];		
	        } 
	        else 
	        {
	            $page_offset = 0;
	        }
			if ($page_offset<0)
			{
	            $page_offset=0;
			}
	 		
	 		//分页url
	 		$base_url = site_url('borrow/recycle/page').'/';
	 		
	 		//每页显示数据条数
	 		$per_page = 3;
	 		$data['per_page'] = $per_page;
	 		
	 		//数据总数
	 		$this->load->model('borrow_model');
	 		$data['total_rows'] = $this->borrow_model->total('1');
	 		
	 		$data['keywords'] = ($this->input->post('keywords')) ? $this->input->post('keywords') : '';
	 		
	 		//total pages
	 		$data['total_pages'] = ceil($data['total_rows'] / $per_page);
	 		
	 		//当前页(input)
	 		$data['page'] = $page_offset + 1;
	 		$data['page'] = ($data['page']>$data['total_pages'] && $data['total_pages']>0) ? $data['total_pages'] : $data['page'];
	 		
	 		//first last prev next page
	 		$data['page_first'] = $base_url.'0'.$search_uri;
			$data['page_last'] = $base_url.($data['total_pages']-1).$search_uri;
			$data['page_prev'] = ($data['page']>1) ? $base_url.($data['page']-2).$search_uri : $data['page_first'];
		    $data['page_next'] = ($data['page']<$data['total_pages']) ? $base_url.($data['page']).$search_uri : $data['page_last'];
	 		
	 		//当前页码
	 		$data['cur_page'] = $base_url.($data['page'] - 1).$search_uri;
	 		
	 		//当前页起始数据号
	 		$data['show_start'] = ($data['page'] - 1)*$per_page+1;
	 		
	 		//当前页结束数据号
	 		$data['show_end'] = ($page_offset < $data['total_pages'] - 1) ? ($data['show_start'] + $per_page) : $data['total_rows'];
	 		
	 		//结果集
	 		$data['borrows'] = $this->borrow_model->find($per_page,($data['page'] - 1)*$per_page,'1'); 		
	 		
	 		//print_r($data['readers']);
	 		
	 		// ajax
			if (!empty($segments['ajax']))
			{
				$this->load->view('borrow/ajax_list',$data);
			// 非 ajax
			}
			else
			{
	            $this->load->view('borrow/list',$data);
			}
	 		
	 	}
 }
?>
