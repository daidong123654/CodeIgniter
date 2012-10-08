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
 	   $data['segments'] = $segments;
 	  // print_r($segments);
 	   if($search)
 	   {
			//echo '62';
			//redirect('login');
 	   		$segments['types'] = $types;  //书的类别
 	   		$segments['selecttype'] = $selecttype;
 	   		$segments['keywords']  = $keywords; 	   		 
 	   }
 	   else
 	   {
 	   		$segments['types'] = !empty($segments['booktype']) ? $segments['booktype'] : '';
 	   		$segments['selecttype'] = !empty($segments['selecttype']) ? $segments['selecttype'] : ''; 	   		
 	   		$segments['keywords'] = !empty($segments['keywords']) ? $segments['keywords'] : '';
 	   		//echo "72  : ".$segments['keywords'];
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
 	   		//echo "115";
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
	   $data['page'] = ($data['page']>$data['total_pages'] && $data['total_pages']>0) ? $data['total_pages'] : $data['page'];
		
 	   //第一页   最后一页   前一页   后一页   
 	   $data['page_first'] = $base_url.'0'.$search_url;
 	   $data['page_last'] = $base_url.($data['total_pages'] - 1).$search_url;
 	   $data['page_prev'] = ($data['page'] > 1) ? $base_url.($data['page']-2).$search_url : $data['page_first'];
 	   $data['page_next'] = ($data['page'] < $data['total_pages']) ? $base_url.($data['page']).$search_url : $data['page_last'];
 	   
 	   //当前页  
 	   $data['cur_page'] = $base_url.($data['page'] - 1).$search_url;
 	   
 	   //当前页起始数据号码
 	   $data['show_start'] = ($data['page'] - 1)*$per_page +1;
 	   
 	   // 分类结果集，用于按分类筛选图书
        $this->load->model('category_model');			
	    $data['categorys'] = $this->category_model->find_all_categorys();
 	   
 	   //当前页结束数据号
 	   $data['show_end'] = ($page_offset < $data['total_pages'] - 1) ? ($data['show_start'] + $per_page - 1) : $data['total_rows'];
 	   
 	   //图书结果集 
 	   $is_delete = 0;
 	   $data['books'] = $this->books_model->find_books($options,$per_page,($data['page'] - 1)*$per_page,$is_delete);
 	                                                  //$options,$count=20, $offset=0, $is_delete=0
 	   $data['select'] = array('count'=>$per_page,'offset'=>($data['page'] - 1)*$per_page,'is_delete'=>$is_delete);
 	   
 	   // ajax 
 	   if(!empty($segments['ajax']) || $search == 1)
 	   {
			//echo "209";
 	   		$this->load->view('books/ajax_list',$data);
 	   }
 	   // 非 ajax
 	   else
 	   {		
 	   		$this->load->view('books/books_list',$data); 	   		
	   }
 	   
 	 }
	 
	 
	
	//--------------------------------------------------------------------------------------------
	/**
	 * 添加图书
	 * 
	 * 
	 */
	 function add()
	 {
	 	$this->edit();
	 }
	 
	 //---------------------------------------------------------------------------------------------
	 /**
	  * 编辑图书
	  * 
	  * 
	  */
	  function edit()
	  {
	  	//检查添加图书的权限
	  	if(!admin_priv('books_add'))
	  	{
	  		return show_message2('你没有添加图书的权限!', 'books');
	  	}
	  	//编辑图书的权限
	  	if(!admin_priv('books_edit'))
	  	{
	  		return show_message2('你没有编辑图书的权限!', 'books');
	  	}
	  	
	  	// 分类结果集，用于按分类筛选图书
        $this->load->model('category_model');			
	    $data['categorys'] = $this->category_model->find_all_categorys();
	    
	    // 出版社结果集
        $this->load->model('ISBN_model');			
	    $data['ISBN'] = $this->ISBN_model->find_all_ISBN();
	  	
	  	$params = $this->uri->uri_to_assoc();
	  	//print_r($params);
	  	if( !empty($params['bookID']) && $params['bookID'] > 0)
	  	{
	  		$id = $params['bookID'];
	  		$this->load->model('books_model');
	  		$data['editing'] = $this->books_model->load($id);
	  		//print_r($data);
	  		if(!$data['editing'])
	  		{
	  			return show_message2('无效ID:'.$id,'books');
	  		}
	  		$data['header_text'] = '编辑图书(ID:'.$data['editing']['bookID'].')';
	  	}
	  	else
	  	{
	  		//echo "添加图书";	  
	  		$data['editing'] = array(
			  		'bookID' => null,	 	
				 	//基本信息
				 	'barcode'    => null,
			 	 	'bookname'   => null,
			 	 	'booktype'   => null,
			 	 	'author'     => null,
			 	 	'translator' => null,
			 	 	'price'      => null,
			 	 	'page'       => null,
			 	 	'keywords'   => null,
			 	 	'bookrack'   => null,
			 	 	'storge'     => null,
			 	 	'publishtime'=> null,
			 	 	'ISBN'       => NULL
	  		);
	  		
			$data['header_text'] = '添加图书';
	  	} 	
	  	$this->load->view('books/books_edit',$data);
	  }
	  
	  //--------------------------------------------------------------------------------------
	  /**
	   * 提交数据
	   * 
	   */
	 function save()
	 {
	 	//保存后并继续编辑信号
	 	$re_edit = $this->input->post('re_edit');
	 	
	 	//图书id
	 	$bookID = $this->input->post('bookID');	 	
	 	//基本信息
	 	$barcode    = $this->input->post('barcode'); //
 	 	$bookname   = $this->input->post('bookname'); //
 	 	$booktype   = $this->input->post('booktype');//
 	 	$author     = ($this->input->post('author')) ? $this->input->post('author') :0;
 	 	$translator = ($this->input->post('translator')) ? $this->input->post('translator') : 0;
 	 	$price      = ($this->input->post('price')) ? $this->input->post('price') : 0;
 	 	$page       = ($this->input->post('page')) ? $this->input->post('page') : 0;
 	 	$keywords   = ($this->input->post('keywords')) ? $this->input->post('keywords') : 0;
 	 	$bookrack   = ($this->input->post('bookrack')) ? $this->input->post('bookrack') : 0;
 	 	$storge     = $this->input->post('storge'); //
 	 	$publishtime= ($this->input->post('publishtime')) ? $this->input->post('publishtime') : 0; 
 	 	$ISBN       = ($this->input->post('ISBN')) ? $this->input->post('ISBN') : 0; 
 	 	
 	 	//加载表单验证类
 	 	$this->load->library('form_validation'); 	 	
 	 	
 	 	//设置表单验证数据规则
 	 	$this->set_save_form_rules();
 	 	
 	 	//如果表单验证通过就继续
 	 	if($this->form_validation->run() == TRUE)
 	 	{
 	 		$datetime = date('Y-m-d H:i:s');
 	 		
 	 		//把数据提交给模型 
 	 		$this->load->model('books_model');
 	 		
 	 		$this->books_model->bookID = $bookID;
 	 		
 	 		$this->books_model->bookname = $bookname;
 	 		$this->books_model->barcode = $barcode;
 	 		$this->books_model->booktype = $booktype;
 	 		$this->books_model->bookrack = $bookrack;
 	 		$this->books_model->author = $author;
	 	 	$this->books_model->translator = $translator;
	 	 	$this->books_model->price = $price;
            $this->books_model->page = $page; 	 	 
	 	 	$this->books_model->keywords = $keywords;	
	 	 	$this->books_model->storge = $storge;
	 	 	$this->books_model->publishtime = $publishtime;	
	 	 	$this->books_model->ISBN = $ISBN;
	 	 	//echo $bookID;
	 	 	//更新
	 	 	if($bookID)
	 	 	{
	 	 		//echo '353';
	 	 		$this->books_model->UpdateDate = $datetime;
	 	 		$old_book = $this->books_model->load($bookID);
	 	 		$this->books_model->update($bookID);
	 	 		
	 	 		//继续编辑
		 	 	if($re_edit)
		 	 	{
		 	 		//echo $bookID;
		 	 		show_message2('"图书(ID:'.$bookID.')" 已更新!', 'books/edit/id/'.$bookID);
		 	 	}
		 	 	//返回列表
		 	 	else
		 	 	{
		 	 		show_message2('"图书(ID:'.$bookID.')" 已更新!', 'books');
		 	 	}
	 	 	}
	 	 	
	 	 	//添加新书
	 	 	else
	 	 	{
	 	 		//echo '373';
	 	 		$this->books_model->add();
	 	 		$newly_one = $this->books_model->get_newly_one();
	 	 		//继续添加
		 	 	if($re_edit)
		 	 	{
		 	 		//echo $bookID;
		 	 		show_message2('"图书(ID:'.$bookID.')" 已添加!', 'books/edit/id/'.$newly_one['bookID']);
		 	 	}
		 	 	//返回列表
		 	 	else
		 	 	{
		 	 		show_message2('"图书(ID:'.$bookID.')" 已添加!', 'books');
		 	 	}	 	 
	 	 	}	 	 	 		
 	 	}
 	 	
 	 	//插入失败
 	 	else
 	 	{
 	 		show_message2('数据插入失败！','books/eidt');
 	 	}
 	 		
	 }
	 
	 //------------------------------------------------------------------------------------------
	 /**
	 *删除书籍
	 *
	 */
	 function delete($id)
	 {
		 // 检验操作权限
		if (!admin_priv('books_del'))
		{
			return show_message2('你没有此项操作的权限!', 'books');
		}

		$params = $this->uri->uri_to_assoc();
        if (isset($params['id']) && ($id = $params['id']) > 0){		

			// 删除图书
            $this->load->model('books_model');
            if ($this->books_model->delete($id)){
                //echo $id;
				show_message2('"图书(ID:'.$id.')" 已被永久删除!', 'books/recycle');
            } 
			else 
			{
                //return false;
				return show_message2('无效ID:'.$id, 'books');
            }
        }
	}
	
	// --------------------------------------------------------------------
    /**
	 * 入回收站
	 * 和delete的操作一样
	 *
	 */	
	function in_recycle()
    {
		if (!admin_priv('books_del')){
			return show_message2('你没有此项操作的权限!', 'books');
		}

        $segments = $this->uri->uri_to_assoc(); 
		$books_id = (int)$segments['id'];
		$this->load->model('books_model');
        $this->books_model->in_recycle($books_id);

		show_message2('"图书(ID:'.$books_id.')" 已被放入回收站!', 'books');
	}
	
	// --------------------------------------------------------------------
    /**
	 * 出回收站
	 * 和delete的操作相反
	 *
	 */	
	function out_recycle()
    {
		if (!admin_priv('books_del')){
			return show_message2('你没有此项操作的权限!', 'books');
		}

        $segments = $this->uri->uri_to_assoc(); 
		$books_id = (int)$segments['bookID'];
		$this->load->model('books_model');
        $this->books_model->out_recycle($books_id);

		show_message2('"图书(ID:'.$books_id.')" 已被还原!', 'books');
	} 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	// --------------------------------------------------------------------
    /**
	 * 设置表单数据规则
	 *
	 */	
	function set_save_form_rules()
    {
        $rules['bookname'] = 'required|max_lenth[70]';
        $rules['bacode']   = 'required|numeric';	
        $rules['booktype'] = 'required';
        $rules['storge'] = 'required|greater_than[0]'; 
               
		$this->form_validation->set_rules($rules);		
    } 
    
    //-----------------------------------------------------------------------------------------
    /**
     * 图书回收站
     * 
     */
     function recycle()
     {
     	
 	 	$keywords= ($this->input->post('keywords') ) ? ($this->input->post('keywords')) : 0;     //查询值  
 	 	$types= ($this->input->post('booktype')) ? ($this->input->post('booktype')) : 0;
 	 	$selecttype = ($this->input->post('selecttype') ) ? ($this->input->post('selecttype')) : 0;     //用来存放查询方式（对应表中的属性名） 
 	 	$search = $this->input->post('search');    //通过search将数据查询分为搜索和分页查询
 	 	$page = $this->input->post('page');
 	   	
 	   	$page = (int) $page; 	   	
 	   
 	    
 	   //分页+查询url设置
 	   $segments = $this->uri->uri_to_assoc();
 	   $data['segments'] = $segments;
 	  // print_r($segments);
 	   if($search)
 	   {
			//echo '62';
			//redirect('login');
 	   		$segments['types'] = $types;  //书的类别
 	   		$segments['selecttype'] = $selecttype;
 	   		$segments['keywords']  = $keywords; 	   		 
 	   }
 	   else
 	   {
 	   		$segments['types'] = !empty($segments['booktype']) ? $segments['booktype'] : '';
 	   		$segments['selecttype'] = !empty($segments['selecttype']) ? $segments['selecttype'] : ''; 	   		
 	   		$segments['keywords'] = !empty($segments['keywords']) ? $segments['keywords'] : '';
 	   		//echo "72  : ".$segments['keywords'];
 	   } 	   
 	 
 	   //现在只能实现类别+关键字查询
 	   $search_url = '/booktype/'.$segments['types'].'/'.$segments['selecttype'].'/'.$segments['keywords'];
 	  
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
 	   		//echo "115";
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
 	   $base_url = site_url('books/recycle/page').'/';
 	   
 	   //每页显示条数
 	   $per_page = 15;
 	   
 	   //数据总数
 	   $this->load->model('books_model');
 	   $data['total_rows'] = $this->books_model->count_books($options,'1');
 	   
 	   //总页数 
 	   $data['total_pages'] = ceil($data['total_rows'] / $per_page);
 	   
 	   //当前页(input) 
 	   $data['page'] = $page_offset+1;
	   $data['page'] = ($data['page']>$data['total_pages'] && $data['total_pages']>0) ? $data['total_pages'] : $data['page'];
		
 	   //第一页   最后一页   前一页   后一页   
 	   $data['page_first'] = $base_url.'0'.$search_url;
 	   $data['page_last'] = $base_url.($data['total_pages'] - 1).$search_url;
 	   $data['page_prev'] = ($data['page'] > 1) ? $base_url.($data['page']-2).$search_url : $data['page_first'];
 	   $data['page_next'] = ($data['page'] < $data['total_pages']) ? $base_url.($data['page']).$search_url : $data['page_last'];
 	   
 	   //当前页  
 	   $data['cur_page'] = $base_url.($data['page'] - 1).$search_url;
 	   
 	   //当前页起始数据号码
 	   $data['show_start'] = ($data['page'] - 1)*$per_page +1;
 	   
 	   // 分类结果集，用于按分类筛选图书
        $this->load->model('category_model');			
	    $data['categorys'] = $this->category_model->find_all_categorys();
 	   
 	   //当前页结束数据号
 	   $data['show_end'] = ($page_offset < $data['total_pages'] - 1) ? ($data['show_start'] + $per_page - 1) : $data['total_rows'];
 	   
 	   //图书结果集 
 	   $is_delete = 1;
 	   $data['books'] = $this->books_model->find_books($options,$per_page,($data['page'] - 1)*$per_page,$is_delete);
 	                                                  //$options,$count=20, $offset=0, $is_delete=0
 	   $data['select'] = array('count'=>$per_page,'offset'=>($data['page'] - 1)*$per_page,'is_delete'=>$is_delete);
 	   
 	   // ajax 
 	   if(!empty($segments['ajax']) || $search == 1)
 	   {
			//echo "209";
 	   		$this->load->view('books/recycle_ajax_list',$data);
 	   }
 	   // 非 ajax
 	   else
 	   {		
 	   		$this->load->view('books/recycle_list',$data); 	   		
	   }
     }
	 
	
 } 
 
?>
