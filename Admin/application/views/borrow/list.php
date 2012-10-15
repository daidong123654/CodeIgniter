<?php
/*
 * Created on 2012-10-12
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 //print_r($borrows);
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

$(document).ready(function() {
  $('#search-action').click(function(){
   $.post('<?php echo site_url('borrow/return_back')?>', $('#search-form').serialize(), function(data) {
	  $('.x-grid3-row').remove();
	  $('#page').remove();
	  $('.x-grid3-row',data).appendTo($('#listTable tbody'));	  
	  $('#page',data).appendTo($('#content'));

	  pageStyle();
	  pageClick()
	  $('#listTable').alternateRowColors().eventRowColors();
    });
  });

});


 
function in_recycle(id,obj)
{
	if (confirm('确定归还图书？')){    
	window.location.href= '<?php echo site_url('borrow/return_back/id')?>'+'/'+id;
    }
}

function listEdit(obj, field, id)
{
  var tag = obj.firstChild.tagName;

  if (typeof(tag) != "undefined" && tag.toLowerCase() == "input")
  {
    return;
  }

  /* 保存原始的内容 */
  var org = $(obj).html();
  var val = $(obj).text();

  /* 创建一个输入框 */
  var txt = $('<input/>');
  (val == 'N/A') ? txt.val('') : txt.val(val);
  txt.css('width',$(obj).outerWidth()+50+'px');

  /* 隐藏对象中的内容，并将输入框加入到对象中 */
  $(obj).html('');
  $(obj).append(txt);
  txt.focus();

  /* 编辑区输入事件处理函数 */
  txt.keypress(function(event){
    if (event.which == 13){
		$(txt).blur();
		return false;
	}

	if (event.which == 27){
		txt.parent().html(org);
	}
  });
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
  <span style="width: 130px;" class="x-tab-strip-inner">
  <span class="x-tab-strip-text">借阅列表</span>
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
	
	  <td  onClick="window.location.href='<?php echo site_url('borrow/add')?>'"><table style="width: hidden;"  class="button x-btn-wrap x-btn x-btn-text-icon " border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	  <td class="x-btn-left"><i>&nbsp;</i></td>
	  <td class="x-btn-center" ><em ><button  class="x-btn-text tb-addnew" type="button" >借阅</button></em></td>
	  <td class="x-btn-right"><i></i></td>
	  </tr></tbody></table></td>

	  </tr></tbody></table></div>

	  </div>
	  <!-- /工具栏 -->

	  <!-- 搜索栏 -->
	  <div id="search" class="x-panel-bbar x-panel-body" style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" >
	  <div  class="x-toolbar x-small-editor" style=" padding:2px 0 5px 20px;">
	  <form id="search-form" style="overflow:;">
		  <input name="search"  type="hidden" value="1" />
		  <input id="search_page" name="page"  type="hidden" value="<?php  echo $page;  ?>" />		  
		 
		  关键字 <input type="text" name="keywords" size="20" class="x-form-text x-form-field"  value="<?=$keywords?>"  />
		  &nbsp; &nbsp; &nbsp;
		  <button id="search-action" class="x-btn-text" type="button">搜索</button>
	  </form>
	  </div></div>
	  <!-- /搜索栏 -->
	  
	  <!-- 内容 -->
	  <div style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" id="content" class="x-panel-body" >
	    <div class="list-div " id="listDiv" style="margin-bottom:0px;overflow:auto">	      
		  <table cellpadding="3" cellspacing="0" id="listTable" >		  
          <thead>
		  <tr class="x-grid3-header">
		  <!--
			<th class="sort-numeric " >
			<div class="x-grid3-hd-inner ">编号<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th> -->
		  
			<th class="sort-numeric " >
			<div class="x-grid3-hd-inner ">ID<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="sort-alpha" >
			<div class="x-grid3-hd-inner">书籍名称/id<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="sort-alpha">
			<div class="x-grid3-hd-inner">分类<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>
			<th class="sort-alpha">
			<div class="x-grid3-hd-inner">单价/元<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>


			<th class="sort-numeric ">
			<div class="x-grid3-hd-inner">借书人/id<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >

			<th class="sort-numeric " >
			<div class="x-grid3-hd-inner">借书人Email<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			
			
			

			<th >
			<div class="x-grid3-hd-inner">借出日期<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >
			
			<th >
			<div class="x-grid3-hd-inner">归还日期<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >

			<th >
			<div class="x-grid3-hd-inner">条形码</div></th >
			<th >
			<div class="x-grid3-hd-inner">操作</div></th >
		  </tr>
          </thead>
		  
		  <tbody>
		  <?php  
		  if($page==1)
		  {
			$num=1;
		  }
		  else
		  {
			$num = ($page-1)*$per_page;
		  }
		  foreach ($borrows as $value)
		  { 
		  ?>
		  <tr class="x-grid3-row " >
		  <!--<td><div class="x-grid3-cell-inner "><?php //echo $num ?></div></td>-->
			<td><div class="x-grid3-cell-inner "><?php echo $value['id'] ?></div></td>
			
			<td ><div class="x-grid3-cell-inner " ><?php echo $value['bookname']; ?></span></div></td>	
			<td ><div class="x-grid3-cell-inner "><?php echo $value['booktypename'].'/'.$value['bookID'] ?></div></td>		
			<td ><div class="x-grid3-cell-inner "><?php echo $value['price'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['readername'].'/'.$value['reader'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['readerEmail'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['borrowtime'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['returntime'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['barcode'] ?></div></td>
			
			<td ><div class="x-grid3-cell-inner ">
			 
			 <a href='#' id="in_recycle" style="text-decoration:none"  title='放入回收站' onclick="in_recycle('<?php echo $value['id']?>',this)">
			 <img src="<?php echo base_url()?>images/out_recycle.gif" border="0" width="16" height="16" alt='放入回收站'>
			 </a>
			</div></td>
		  </tr>		  
		  <?php
		  $num++;
		  } 
		  ?>
		</tbody></table>
		</div>
		
		<!-- 分页显示 -->
		<?php
		//print_r($value);
		
		$data['total_pages'] = $total_pages;
		$data['page_first'] = $page_first;
		$data['page_prev'] = $page_prev;
		$data['total_pages'] = $total_pages;
		$data['page'] = $page;
		$data['page_next'] = $page_next;
		$data['page_last'] = $page_last;
		$data['show_start'] = $show_start;
		$data['show_end'] = $show_end;
		$data['total_rows'] = $total_rows;
		$this->load->view('widget/recycle_pagination', $data)
	    ?>
		<!-- /分页显示 -->
		</div><!-- /内容 -->	   
  </div></div></div></div></div></div></div>
  <!-- /菜单体 --> 
</div>
</body>
</html>

