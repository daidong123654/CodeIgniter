<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class news extends CI_Controller
{
	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('news_model');
		$this->load->helper('url');
	}
	public function index()
	{
		$data['news'] = $this->news_model->get_news();
		$data['title'] = 'News archive';
		
		//print_r($data);
		$this->load->view('news/index', $data);

	}
	public function view($slug)
	{
		$data['news_item'] = $this->news_model->get_news($slug);
		
		if (empty($data['news_item']))
		{
			show_404();
		}

		$data['title'] = $data['news_item']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('news/view', $data);
		$this->load->view('templates/footer');
	}	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('CuteEditor');
  
		$data['title'] = 'Create a news item';
  
		$this->form_validation->set_rules('title', 'Title', 'required');  //设置必须是填写的
		$this->form_validation->set_rules('text', 'text', 'required');	  //设置必须是填写的
  
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('news/create');
    
		}
		else
		{
			$this->news_model->set_news();
			
			$this->load->view('news/success');
			
		}
	}
}
?>