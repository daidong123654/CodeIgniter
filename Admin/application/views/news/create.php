<?php
/*
 * Created on 2012-9-27
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 //echo "admin_edit.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->

	<?php //echo base_url();?>
    <link href="<?php echo base_url();?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/bootstrap.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo base_url();?>/css/css.css" rel="stylesheet" type="text/css" />	
	<script src="<?php echo base_url();?>/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>	

<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/main.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script language="JavaScript"> var base_url = '<?php echo base_url()?>'; </script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/admin.js"></script>


</head>
<body  class="x-border-layout-ct" style="position: relative;" >
<div id="msg"></div>
<div id="main-tabs" class="x-tab-panel x-border-panel" style="width:100%;height:100% ">

  <!-- 当前菜单 -->
  <div id="crt-menu" class="x-tab-panel-header x-unselectable">
  <div class="x-tab-strip-wrap">
  <ul class="x-tab-strip x-tab-strip-top">
  <li class="x-tab-strip-active" >
  <a class="x-tab-right" href="#" onClick="return false;">
  <em class="x-tab-left">
  <span style="width: 130px;" class="x-tab-strip-inner">
  <span class="x-tab-strip-text"><?php 
  if(empty($header_text)) echo "添加新闻";
  else echo $header_text;
  
  ?></span>
  </span>
  </em>
  </a>
  </li>
  <li class="x-tab-edge"></li>
  <div class="x-clear"></div>
  </ul>
  </div>
  </div>

  <!-- 工具栏 -->
  <div id="tool" class="x-panel-tbar x-panel-tbar-noheader"><div class="x-toolbar "><table cellspacing="0"><tbody><tr>
	
	<td id="save"><table class="x-btn-wrap x-btn x-btn-text-icon button" border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	<td class="x-btn-left"><i>&nbsp;</i></td>
	<td class="x-btn-center"><em ><button class="x-btn-text tb-save" type="button">保存</button></em></td>
	<td class="x-btn-right"><i>&nbsp;</i></td>
	</tr></tbody></table></td>

	<td><span class="ytb-sep"></span></td>

	<td id="saveEdit"><table class="x-btn-wrap x-btn x-btn-text-icon button" border="0" cellpadding="0" cellspacing="0" ><tbody><tr><td class="x-btn-left"><i>&nbsp;</i></td><td class="x-btn-center"><em ><button class="x-btn-text tb-renew" type="button">保存并继续编辑</button></em></td><td class="x-btn-right"><i>&nbsp;</i></td></tr></tbody></table></td>

	<td><span class="ytb-sep"></span></td>

	<td id="reset"><table  class="x-btn-wrap x-btn x-btn-text-icon button" border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	<td class="x-btn-left"><i>&nbsp;</i></td>
	<td class="x-btn-center"><em ><button class="x-btn-text tb-resume" type="button">重置</button></em></td>
	<td class="x-btn-right"><i></i></td>
	</tr></tbody></table></td>

	<td><span class="ytb-sep"></span></td>

	<td onClick="window.location.href='<?php echo site_url('news')?>'"><table  class="x-btn-wrap x-btn x-btn-text-icon button" border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	<td class="x-btn-left"><i>&nbsp;</i></td>
	<td class="x-btn-center"><em ><button class="x-btn-text tb-owner" type="button">列表</button></em></td>
	<td class="x-btn-right"><i></i></td>
	</tr></tbody></table></td>
  

	</tr></tbody></table></div></div>
  <!-- /工具栏 -->

  <!-- 表单 -->
	<div id="menu-body" class="x-panel-body x-panel-body-noheader x-panel-body-noborder x-border-layout-ct "  style="height:100%">

	 <div class="x-panel x-panel-noborder" style="padding: 10px 10px 0px;">
	 <div class="x-panel-bwrap">
	 <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder">
	 <div class="bottomLine">
	 <font class="lineTitle" color="dimgray">新闻内容</font>
	 </div>
	 </div>
	 </div>
	 </div>

	 <div class="x-panel x-form-label-left ">
	 <div class="x-panel-bwrap form-padding"> 
	 <form style="padding: 5px 5px 0pt; " class=" x-form" method="post" action="<?php echo site_url('news/create')?>" name="form" > 
		

	<label for="title">Title</label>
		<input id="inputSuccess" type="input" name="title" />
		<!--<textarea name="text"></textarea><br/>-->
		<br/>

		<label for="text">Text(拖动右下角来改变大小)</label>
		
		
		<div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">详细描述:</label><br/>
		  <div   style="padding-left: 80px;">
	      <?php echo $fckeditor;  ?>
		  </div>
		  <div class="x-form-clear-left"></div>
	    </div>
		
		
		<input class="btn btn-success" type=submit name="AdminLogin" value="Create news item"/>
	
	 </form>
	 
	 
	 <?php
	   
	 ?>
  


	 
	 </div>
	 </div>
	</div>	
  <!-- /表单 -->

</div>
</body>
</html>

