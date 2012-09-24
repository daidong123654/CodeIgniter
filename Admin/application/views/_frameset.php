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
<script type="text/javascript" language="javascript">

if(window.top != window)
{
	window.top.location.href = document.location.href;
}

</script>
</head>
<!--__frameset.php  line 24 <br/>-->
<?php //echo site_url('frameset/top')?> <br/>
<!--<a href="<?php echo site_url('frameset/top')?>">ddd</a>--> 

<? //$this->load->view('_top') ;
   //$this->load->view('menu') ;
   //$this->load->view('books/menu');

?>

<body style="background:#abc7ec;">


<div style="margin-top:-15px;background:#abc7ec;width:100%;float:left;">
	<iframe scrolling="no" frameborder='0' height="40px" width="100%" name="header-frame"   src="<?php echo site_url('frameset/top') ?>"></iframe>
</div>
<div style="margin-top:15px;">

	<iframe scrolling="no" frameborder='1' height="90%" width="15%" name="header-frame"   src="<?php echo site_url('frameset/menu/books') ?>"></iframe>
	<iframe scrolling="no" frameborder='1' height="90%" width="83%" name="header-frame"   src="<?php echo site_url('books') ?>"></iframe>
</div>

</body>
</html>

