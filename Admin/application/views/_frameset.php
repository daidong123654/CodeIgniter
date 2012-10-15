<?php
/*
 * 登陆后初始化的界面（这里定向到书籍页面）
 * 
 * Created on 2012-9-24
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */ 
?>
<html>
<head>
<meta content="text/html; charset=utf8"; http-equiv="Content-Type"/> 
<title>HIT-LIBM管理中心</title>
<style type="text/css">
#admin{	height:28px;right:10px;	position:absolute;
	top:5px;width:200px;z-index:100;float:left;
	font:bold 13px Arial, Helvetica,sans-serif;
	//background:red;}
#admin  a{color:#15428b;padding:2px;text-decoration:none;font:normal 12px Arial, Helvetica,sans-serif;}
</style>

<script type="Text/Javascript" language="JavaScript">
if (window.top != window)
{
  window.top.location.href = document.location.href;
 	//document.location.href = window.top.location.href  ;
}
</script>


</head>
<!--__frameset.php  line 24 <br/>-->

<!--<a href="#">ddd</a>--> 
<?php //echo site_url('frameset/top')?>

<body style="background:#abc7ec;">

<div style="margin-top:-14px;background:#abc7ec;width:100%;float:left;" id="header-frame">
	<iframe scrolling="no" frameborder='0' height='5%' width="100%" name="header-frame"   src="<?php echo site_url('frameset/top') ?>"></iframe>
</div>

<div id="admin">
 <a href="http://localhost/Library/Reader/">前台&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
 <?php echo $this->session->userdata('name');?>
 &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('login/logout')?>">退出</a>
</div>

<div style="margin-top:15px;" id="frame-body">
	<iframe scrolling="no" frameborder='1' height="93%" width="14%" name="menu-frame"   id="menu-frame"   src="<?php echo site_url('frameset/menu/books') ?>"></iframe>
	<iframe scrolling="no" frameborder='1' height="93%" width="84%"   name="main-frame" id="main-frame"  src="<?php echo site_url('books') ?>"></iframe>
</div>
</body>
</html>

