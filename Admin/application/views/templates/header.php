<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
	<?php $this->load->helper('url'); ?>
	<?php //echo base_url();?>
    <link href="<?php echo base_url();?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/bootstrap.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/css.css" rel="stylesheet" type="text/css" />	
	<script src="<?php echo base_url();?>/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	
<script language="javascript">
function FrontPage_Form_Validator(theForm)
{
	if(theForm.readername.value=="")
	{
		alert("请输入用户名！");
		theForm.readername.fous();
		return (false);
	}
	if(theForm.readerpass.value=="")
	{
		alert("请输入密码！");
		theForm.readerpass.fous();
		return (false);
	}
	if(theForm.readeremail.value=="")
	{
		alert("请输入email！");
		theForm.readeremail.fous();
		return (false);
	}
	
	if(theForm.readerpass.value!=theForm.ConfigPassword)
	{
		alert("两次密码不一样！");
		theForm.readerpass.fous();
		return (false);
	}
	return (true);
}
</script>
	
	
	
  </head>
  <body>    
	<h1 style="text-align:center;font-family:'隶书'">图书馆管理系统</h1>
	<p><?php //echo base_url();?></p>  
<div id="wrap">	
<div class="1111btn btn-large btn-block">
<p>
  <a href="<?php echo base_url();?>index.php"><button class="btn btn-primary" type="button">Main Page</button></a>
  <a href="<?php echo base_url();?>index.php/news"><button class="btn" type="button">News Page</button> </a>
  <a href="<?php echo base_url();?>index.php/news/create"><button class="btn btn-success" type="button">Create News</button></a>
  <a href="<?php echo base_url();?>index.php/about"><button class="btn btn-info" type="button">Info About Us</button></a>
  <a href="<?php echo base_url();?>index.php/admin"><button class="btn btn-danger" type="button">Admin  Login</button></a>
  <a href="<?php echo base_url();?>index.php/reader"><button class="btn btn-warning" type="button">Reader  Login</button></a>
  <a href="<?php echo base_url();?>index.php/reader/readerregister"><button class="btn btn-inverse" type="button">Reader  Register</button></a>
  
</p>

</div>
