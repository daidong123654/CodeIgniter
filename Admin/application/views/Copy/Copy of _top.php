<?php
/*
 * 表头
 * 
 * Created on 2012-9-24
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */ 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>


<script language="JavaScript"> 

var menuFrame = parent.document.getElementByName('menu-frame');
var frmBody = parent.document.getElementByName('frame-body');
function changeMenu(menuSrc)
{   	
    $(menuFrame).attr('src',menuSrc);
}

$(document).ready(function() {
	$('#nav1').find('li').click(function(){
		$('#nav1').find('a').removeClass();
		$(this).find('a').addClass('tab-front');
		frmBody.cols="230, *";
	})
});

</script>


<style type="text/css">
#nav1{height:28px;left:24px;position:absolute;top:5px;width:768px;z-index:100;float:left}
#nav1 ul{width:572px;height:25px;}
#nav1 li{float:left;line-height:22px;word-spacing:6px;margin-right:3px}
#nav1 li a{color:#15428b;padding:2px 10px;text-decoration:none;font:bold 13px Arial, Helvetica,sans-serif;}
#nav1 li a:hover{text-decoration:none;color:#fff;background:#abc7ec}
#nav1 .tab-front{color:#fff;background:#abc7ec}

#admin{
	height:28px;
	right:10px;
	position:absolute;
	top:5px;
	width:200px;
	z-index:100;
	float:left;
	font:bold 13px Arial, Helvetica,sans-serif;
	//background:red;
}
#admin  a{color:#15428b;padding:2px;text-decoration:none;font:normal 12px Arial, Helvetica,sans-serif;}
</style>
</head>
<body class=" x-border-layout-ct">
<div id="nav1"> <!--主菜单布局-->
	<ul>
	<!--<li ><a href="<?php echo site_url('books')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/books');?>')">图书管理</a></li>-->
	<li><a class="tab-front"href="<?php echo site_url('books')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/books');?>')">图书管理</a></li>
	<li><a href="<?php echo site_url('readers')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/readers');?>')">读者管理</a></li>	
	<li><a href="<?php echo site_url('news')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/news');?>')">新闻管理</a></li>
	<li><a href="<?php echo site_url('message')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/message');?>')">留言管理</a></li>
	<li><a href="<?php echo site_url('borrow')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/borrow');?>')">借阅管理</a></li>
	<li><a href="<?php echo site_url('admin')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/admin');?>')">管理员</a></li>
	<li><a href="<?php echo site_url('system')?>" target="main-frame" onclick="changeMenu('<?php echo site_url('frameset/menu/system');?>')">系统管理</a></li>
	</ul>
</div>

<div id="admin">&nbsp;&nbsp;<a target="_blank" href="<?php echo front_url();?>">前台<a/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('name');?>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_top" href="<?php echo site_url('logout')?>">退出<a/></div>


</body>
<html>

