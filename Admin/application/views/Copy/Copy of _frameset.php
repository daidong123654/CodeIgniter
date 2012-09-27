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
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<title>HIT-LIBM 管理中心</title>
<script type="Text/Javascript" language="JavaScript">
<!--

if (window.top != window)
{
  window.top.location.href = document.location.href;
}


//-->
</script>
</head>
<!--__frameset.php  line 24 <br/>-->

<!--<a href="<?php echo site_url('frameset/top')?>">ddd</a>--> 

<? //$this->load->view('_top') ;
   //$this->load->view('menu') ;
   //$this->load->view('books/menu');

?>
<frameset border="0" framespacing="0" rows="35,*" >

    <frame id="header-frame" scrolling="no" frameborder="no" name="header-frame" src="<?php echo site_url('frameset/top') ?>" />

    <frameset id="frame-body" border="0" framespacing="0" cols="230, *" name="frame-body">
		<frame scrolling="no" frameborder="no" name="menu-frame" id="menu-frame" src="<?php echo site_url('frameset/menu/books') ?>"/>
		<frame scrolling="no" frameborder="no" name="main-frame" id="main-frame" src="<?php echo site_url('books') ?>"/>
    </frameset>

</frameset>

</html>
<!--
<body style="background:#abc7ec;">

<div style="margin-top:-25px;background:#abc7ec;width:100%;float:left;">
	<iframe scrolling="no" frameborder='0' height="40px" width="100%" name="header-frame"   src="<?php echo site_url('frameset/top') ?>"></iframe>
</div>

<div id="admin">
 <a href="http://localhost/Library/Reader/">前台&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
 <?php //echo $this->session->userdata('name');?>
 &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('login/logout')?>">退出</a>
</div>

<div style="margin-top:15px;">
	<iframe scrolling="no" frameborder='1' height="90%" width="15%" name="menu-frame"   src="<?php echo site_url('frameset/menu/books') ?>"></iframe>
	<iframe scrolling="no" frameborder='1' height="90%" width="83%" name="main-frame"   src="<?php echo site_url('books') ?>"></iframe>
</div>

</body> -->