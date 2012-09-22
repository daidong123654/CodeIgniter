<?php
/*
 * Created on 2012-9-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reader extends CI_Controller
{
	public function __construct()
	{ 
		parent::__construct();
		$this->load->model("Reader_model");
		$this->load->helper('url');
		$this->load->library("session");
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$this->load->view('templates/header');
		$this->load->view('reader/readerlogin');
		$this->load->view('templates/footer');
	}
	
	function ReaderCheckLogin()
	{
		
		if($this->session->userdata("readerid"))
		{			
			$this->load->view('templates/header');
			echo "<h1>已经登陆</h1>";
			$this->load->view('templates/footer');
			//启动相应视图
			return true;
		}
		else
		{
			$this->load->view("template/header");
			echo "<h1>没有登录</h1>";
			$this->load->view("ReaderLogin");
			$this->load->view("template/footer");
			return false;
		}
	}
	
	function ReaderLoginout()
	{		
		$this->session->unset_userdata("readerid");
		$this->load->view('templates/header');
		$this->load->view('reader/readerlogin');
		$this->load->view('templates/footer');
	}
	
	
	function ReaderLogin()
	{	
		$this->form_validation->set_rules('readername', 'readername', 'required');  //设置必须是填写的
		$this->form_validation->set_rules('readerpass', 'readerpass', 'required');	  //设置必须是填写的
		
		if($this->form_validation->run()==FALSE)
		{
				$this->load->view('templates/header');				
				$this->load->view('reader/login');				
				$this->load->view('templates/footer');	
		}	
		elseif(isset($_POST['login']) && !$this->form_validation->run()==FALSE)
		{
			$reader=$this->Reader_model->MReaderSelect($_POST['readername']);
			//print_r($reader);
		}
		
		if($reader)//登陆用户名存在
		{
			//var_dump($reader);
			if($reader['ReaderPass'] ==md5($_POST['readerpass']) )
			{
				//print_r($reader);				
				//将个人信息数组传递过去
				$data=array("ReaderName"=>$reader['ReaderName'],"sex"=>$reader['sex'],"age"=>$reader['age'],
				"readerbarcode"=>$reader['readerbarcode'],"birthday"=>$reader['birthday'],"papertype"=>$reader['papertype'],
				"papercode"=>$reader['papercode'],"readerteltphone"=>$reader['readertelephone'],"readerEmail"=>$reader['readerEmail'],
				"registrationdate"=>$reader['registrationdate'],"opreatorid"=>$reader['opreatorid'],"credit"=>$reader['credit'],
				"readertypeid"=>$reader['readertypeid']);
				
				
				
				$this->load->view('templates/header');
				$this->load->view('reader/loginsuccess',$data);
				$this->load->view('templates/footer');			
				//var_dump($reader);		
				
				$readersession=array("readerid"=>$reader['readerid']);
				$this->session->set_userdata($readersession);
				//echo '<br/>';
				//echo $this->session->userdata("readerid");
			}
			else
			{				
				$this->load->view('templates/header');
				$this->load->view("reader/wrongpass");				
				$this->load->view('reader/readerlogin');				
				$this->load->view('templates/footer');
			}
		}
		else //用户不存在
		{			
			$readername=array("name"=>$_POST['readername']);
			$this->load->view('templates/header');
			$this->load->view('reader/noreader',$readername);			
			$this->load->view('reader/readerlogin');
			$this->load->view('templates/footer');
		}
	}
	
	function ReaderRegister()
	{	
		$this->form_validation->set_rules('readername', 'readername', 'required');  //设置必须是填写的
		$this->form_validation->set_rules('readerpass', 'readerpass', 'required');	  //设置必须是填写的
		$this->form_validation->set_rules('readeremail', 'readeremail', 'required');	  //设置必须是填写的
		$this->form_validation->set_rules('papertype', 'papertype', 'required');	  //设置必须是填写的
		$this->form_validation->set_rules('papercode', 'papercode', 'required');	  //设置必须是填写的
  		//这里的数组可以由post得到,这里还要检查的。。。。
  		if($this->form_validation->run()==FALSE)   //填写格式不正确
		{
				$this->load->view('templates/header');
				$this->load->view('reader/registerfail');
				$this->load->view('reader/register');				
				$this->load->view('templates/footer');	
		}	
  		
  		//格式正确
		elseif(isset($_POST['register']) && $this->form_validation->run()==TRUE )
		{
			$ReaderRegisterinfo['ReaderName']=$_POST['readername'];
			$ReaderRegisterinfo['ReaderPass']=md5($_POST['readerpass']);
			$ReaderRegisterinfo['Readeremail']=$_POST['readeremail'];
			$ReaderRegisterinfo['papertype']=$_POST['papertype'];
			$ReaderRegisterinfo['papercode']=$_POST['papercode'];			
			
			//print_r($ReaderRegisterinfo);
			if($_POST['readerpass'] == $_POST['ConfigPassword'])
			{
				//开始检查用户名邮箱证件有没有被注册
				if($this->Reader_model->MReaderSelect($_POST['readername']) )
				//if($this->Reader_model->MReaderSelect($_GET['id']) )
				{
					echo "<script>alert('用户名已经注册！')</script>";
					$this->load->view('templates/header');
					$this->load->view('reader/register');		
					$this->load->view('templates/footer');
					return false;	
				}
				/*else
				{
					echo "用户可以注册";
				}*/
				if($this->Reader_model->MReaderSelect($_POST['readeremail']) )
				{
					echo "<script>alert('邮箱已经注册！')</script>";
					$this->load->view('templates/header');
					$this->load->view('reader/register');		
					$this->load->view('templates/footer');
					return false;
				}
				//echo $_POST['papercode'];
				$query= $this->Reader_model->MReaderSelectPapercode($_POST['papercode']) ;
				///print_r($query);
				if($query && $query[0]->papertype==$_POST['papertype'])
				{
					echo "<script>alert('该证件已经被注册！')</script>";
					$this->load->view('templates/header');
					$this->load->view('reader/register');		
					$this->load->view('templates/footer');
					return false;
				}
				
				else
				{
					$result=$this->Reader_model->MReaderRedister($ReaderRegisterinfo);
					if($result)
					{
						//echo $result;
						$this->load->view('templates/header');
						$this->load->view('reader/registersuccess');		
						$this->load->view('templates/footer');	
					}
					else
					{
						$this->load->view('templates/header');
						$this->load->view('reader/register');		
						$this->load->view('templates/footer');	
					}
				}
				
			}
			else
			{
				echo "两次密码不一样！";
				$this->load->view('templates/header');
				$this->load->view('reader/register');		
				$this->load->view('templates/footer');	
			}
			//$result=$this->Reader_model->MReaderRedister($ReaderRegisterinfo);		
			
		}
		else
		{
			$this->load->view('templates/header');
			$this->load->view('reader/register');		
			$this->load->view('templates/footer');	
		}
		
		
	}
	
	function ReaderUpdate()
	{		
		if(!ReaderCheckLogin())  //没有登录
		{
			$this->load->view('templates/header');
			$this->load->view("reader/nologin");				
			$this->load->view('reader/readerlogin');				
			$this->load->view('templates/footer');
		}
		else
		{	
			$readerid=$this->session->userdata("reader");
			//这里的数组可以由post得到新的信息
			$ReaderRegisterinfo['ReaderName']=$_POST['ReaderName'];
			$ReaderRegisterinfo['ReaderPass']=md5($_POST['ReaderPass']);
			$ReaderRegisterinfo['Readeremail']=md5($_POST['Readeremail']);
			$ReaderRegisterinfo['papertype']=$_POST['papertype'];
			$ReaderRegisterinfo['papercode']=$_POST['papercode'];			
				
			$this->Reader_model->MReaderUpdate($readerid,$ReaderRegisterinfo);	
		}			
	}
	
	/*这个方法是留给管理员的
	function ReaderDel()
	{
		$readerid=1;
		//$this->load->model("Reader_model");
		$this->Reader_model->MReaderDelete($readerid);
	}
	*/
	
	function ReaderSelect()
	{		
		if(!ReaderCheckLogin())  //没有登录
		{
			$this->load->view('templates/header');
			$this->load->view("reader/nologin");				
			$this->load->view('reader/readerlogin');				
			$this->load->view('templates/footer');
		}
		else
		{	
			$readerid=$this->session->userdata("reader");
			$result = $this->Reader_model->MReaderSelect($readerid);
			//var_dump($result);			
		}		
	}
	
}
?>
