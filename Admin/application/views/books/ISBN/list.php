<?php
/*
 * Created on 2012-10-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 //print_r($editing);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url()?>css/main.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script language="JavaScript"> var base_url = '<?php echo base_url()?>'; </script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/admin.js"></script>

<script language="JavaScript"> 

//列表窗口缩放效果
$(document).ready(function() {
  listBody();
});
$(window).resize(function(){
  listBody();
});


function delete_a(id)
{
	if (confirm('确定删除该出版社吗？')){
   
	window.location.href= '<?php echo site_url('ISBN/delete/id')?>'+'/'+id;
    }
}

</script>

</head>

<body  class=" x-border-layout-ct" style="position: relative;" >
<div id="msg"></div>
<div id="main-tabs" class="x-tab-panel x-border-panel" style="left: 5px; top: 0px;">

  <div  id="crt-menu" class="x-tab-panel-header x-unselectable">
  <div  id="crt-menu1" class="x-tab-strip-wrap">
  <ul id="crt-menu2" class="x-tab-strip x-tab-strip-top">
  <li class="x-tab-strip-active" >
  <a class="x-tab-right" href="#" onClick="return false;">
  <em class="x-tab-left">
  <span style="width: 210px;" class="x-tab-strip-inner">
  <span class="x-tab-strip-text">出版社列表 ：<?php echo "（一共有".$totalISBNS."个出版社）";?></span>
  </span>
  </em>
  </a>
  </li>
  <li  class="x-tab-edge"></li>
  <div  class="x-clear"></div>
  </ul>
  </div>
  </div>
  
  <!-- 菜单体 -->
  <div class="x-tab-panel-bwrap border-bottom x-panel-body" >
  <div id="menu-body1" class="x-tab-panel-body x-tab-panel-body-top" >
  <div id="menu-body2" class="x-panel x-panel-noborder" >
  <div  class="x-panel-bwrap">
  <div id="menu-body" class="x-panel-body x-panel-body-noheader x-panel-body-noborder x-border-layout-ct" style="">
  <div id="menu-body3" class="x-panel x-border-panel x-grid-panel" style="left: 0px; top: 0px;">
  <div style="position: relative;"  class="x-panel-bwrap">

      <!-- 工具栏 -->
      <div id="tool" class="x-panel-tbar x-panel-tbar-noheader "><div  class="x-toolbar " style="border-left:0 solid #99bbe8;"><table cellspacing="0"><tbody><tr>
	
	  <td  onClick="window.location.href='<?php echo site_url('ISBN/add')?>'"><table style="width: hidden;"  class="button x-btn-wrap x-btn x-btn-text-icon " border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	  <td class="x-btn-left"><i>&nbsp;</i></td>
	  <td class="x-btn-center" ><em ><button  class="x-btn-text tb-addnew" type="button" >新增</button></em></td>
	  <td class="x-btn-right"><i></i></td>
	  </tr></tbody></table></td>

	  </tr></tbody></table></div>

	  </div>
	  <!-- /工具栏 -->

	
	  
	  <!-- 内容 -->
	  <div style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" id="content" class="x-panel-body" >
	    <div class="list-div " id="listDiv" style="margin-bottom:0px;overflow:auto">	      
		  <table cellpadding="3" cellspacing="0" id="listTable" >		  
          <thead>
		  <tr class="x-grid3-header">
			

			<th class="sort-numeric " >
			<div class="x-grid3-hd-inner ">ID<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="sort-alpha" >
			<div class="x-grid3-hd-inner">ISBN<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th>
			<div class="x-grid3-hd-inner">出版社名称</div></th>

			<th class="sort-numeric ">
			<div class="x-grid3-hd-inner">图数量<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >
			
			
			<th>
			<div class="x-grid3-hd-inner">Email</div></th>

			<th >
			<div class="x-grid3-hd-inner">电话</div></th>

			<th >
			<div class="x-grid3-hd-inner">更新日期<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >
			
			<th >
			<div class="x-grid3-hd-inner">操作</div></th >
		  </tr>
          </thead>
		  
		  <tbody>
		  <?php  
		  foreach ($editing as $value)
		  { 		  
		  ?>
		  <tr class="x-grid3-row " >
			<td><div class="x-grid3-cell-inner "><?php echo $value['id'] ?></div></td>
			<td ><div class="x-grid3-cell-inner " ><span onclick="listEdit(this, 'name', <?php echo $value['id'] ?>)"><?php echo $value['ISBN']; ?></span></div></td>	
			<td ><div class="x-grid3-cell-inner "><?php echo $value['ISBNname'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['booknum'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['Email'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['phone'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['created_at'] ?></div></td>			
			
			<td ><div class="x-grid3-cell-inner ">
			 <a href='<?php echo site_url('ISBN/edit/id/'.$value['id'])?>' style="text-decoration:none" alt='编辑' title='编辑'>
			 <img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16">
			 </a>&nbsp;&nbsp&nbsp;&nbsp;
			  <a href='#' onclick="delete_a('<?php echo $value['id'];?>')" style="text-decoration:none" alt='删除' title='删除'>
			 <img src="<?php echo base_url()?>images/icon_drop.gif" border="0" width="16" height="16">
			 </a>
			</div></td>	
		  </tr>
		  <?php
		  } 
		  ?>
		</tbody></table>
		</div>
		
		</div><!-- /内容 -->	   
  </div></div></div></div></div></div></div>
 
</div>
</body>
</html>