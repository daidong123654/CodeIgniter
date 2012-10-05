<?php
/*
 * Created on 2012-9-28
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
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
<!--

//列表窗口缩放效果
$(document).ready(function() {
  listBody();
});
$(window).resize(function(){
  listBody();
});

$(document).ready(function() {
  $('#search-action').click(function(){
   $.post('<?php echo site_url('books')?>', $('#search-form').serialize(), function(data) {
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
	if (confirm('确定把该书籍放入回收站吗？')){
    /*$.ajax({
	  url: '<?php echo site_url('product/in_recycle/id')?>'+'/'+id,
	  type: 'GET',
	  dataType: 'html',
	  success: function(data){
	    $(obj).parents('tr:first').remove();
		_reset_page();
      }
	});*/
	window.location.href= '<?php echo site_url('product/in_recycle/id')?>'+'/'+id;
    }
}

function listToggle(obj, field, id)
{
	var val = (obj.src.match(/yes.gif/i)) ? 0 : 1;

	$.ajax({
    url: '<?php echo site_url('product/list_toggle')?>/field/'+field+'/id/'+id+'/val/'+val,
    type: 'POST',
    dataType: 'html',
    success: function(data){	
	  obj.src = (data > 0) ? '<?php echo base_url()?>images/yes.gif' : '<?php echo base_url()?>images/no.gif';
    }
  });
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

  /* 编辑区失去焦点的处理函数 */
  txt.blur(function(){
    if ($(this).val() != ''){
      $.ajax({
		url: '<?php echo site_url('product/list_toggle')?>/field/'+field+'/id/'+id+'/val/'+encodeURIComponent($(this).val()),
		type: 'GET',
		dataType: 'html',
		success: function(data){
			//alert(data);
		  $(obj).html(data);
		}
	  });
	}else{
      $(obj).html(org);
	}
    
  });
}
 //--> 
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
  <span class="x-tab-strip-text">书籍列表</span>
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
	
	  <td  onClick="window.location.href='<?php echo site_url('product/add')?>'"><table style="width: hidden;"  class="button x-btn-wrap x-btn x-btn-text-icon " border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	  <td class="x-btn-left"><i>&nbsp;</i></td>
	  <td class="x-btn-center" ><em ><button  class="x-btn-text tb-addnew" type="button" >新增</button></em></td>
	  <td class="x-btn-right"><i></i></td>
	  </tr></tbody></table></td>

	  </tr></tbody></table></div>

	  </div>
	  <!-- /工具栏 -->

	  <!-- 搜索栏 -->
	  <div id="search" class="x-panel-bbar x-panel-body" style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" >
	  <div  class="x-toolbar x-small-editor" style=" padding:2px 0 5px 20px;">
	  <form id="search-form" style="overflow:;" >
		  <input name="search"  type="hidden" value="1" />
		  <input id="search_page" name="page"  type="hidden" value="<?php  echo $page;  ?>" />
		  <select name='booktype'  style="width:130px;height:22px;">
		  <option value=''  >书籍分类</option>
		  <?php foreach($categorys as $value) :  ?>
		  <option value='<?php echo $value['id'];  ?>' <?php if($cat_selected == $value['id']) echo 'selected' ?> ><?php for($i=1;$i<=$value['level'];$i++){ echo '&nbsp;&nbsp;&nbsp;&nbsp;';} ?><?php echo $value['name'];  ?></option>
		  <?php endforeach; ?>
		  </select>
		  &nbsp; &nbsp; 
		  <select name='selecttype'style="width:130px;height:22px;">
		  <option value="<?php echo $temp['selecttype']?>"  >查询方式</option>
			<option value='bookname'>书名</option>
			<option value='author'>作者</option>
			<option value='translator'>译者</option>
			<!--<option value='ISBN'>出版社（出版社编号）</option>-->
		  <?php foreach($brands as $value) :  ?>
		  <option value='<?php echo $value['id'];  ?>'  <?php if($brand_selected == $value['id']) echo 'selected' ?> ><?php echo $value['name'];  ?></option>
		  <?php endforeach; ?>
		  </select>		  
		   &nbsp; &nbsp; 
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
			<th class="sort-numeric " >
			<div class="x-grid3-hd-inner ">ID<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="sort-alpha" >
			<div class="x-grid3-hd-inner">书籍名称<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="sort-alpha">
			<div class="x-grid3-hd-inner">分类<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>


			<th class="sort-numeric ">
			<div class="x-grid3-hd-inner">价格<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >

			<th class="sort-numeric " >
			<div class="x-grid3-hd-inner">库存<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th >
			<div class="x-grid3-hd-inner">作者/翻译者</div></th>

			<th>
			<div class="x-grid3-hd-inner">出版社</div></th>

			<th >
			<div class="x-grid3-hd-inner">书架号</div></th>

			<th >
			<div class="x-grid3-hd-inner">出版日期<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >

			<th >
			<div class="x-grid3-hd-inner">条形码</div></th >
			<th >
			<div class="x-grid3-hd-inner">操作</div></th >
		  </tr>
          </thead>
		  
		  <tbody>
		  <?php  
		  foreach ($books as $value)
		  { 
		  ?>
		  <tr class="x-grid3-row " >
			<td><div class="x-grid3-cell-inner "><?php echo $value['bookID'] ?></div></td>
			<td ><div class="x-grid3-cell-inner " ><span onclick="listEdit(this, 'name', <?php echo $value['bookID'] ?>)"><?php echo $value['bookname']; ?></span></div></td>	
			<td ><div class="x-grid3-cell-inner "><?php echo $value['booktypename'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['price'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['storge'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['author'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['publisher'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['bookrack'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['publishtime'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['barcode'] ?></div></td>
			
			<td ><div class="x-grid3-cell-inner ">
			 <a href='<?php echo site_url('product')?>' style="text-decoration:none" alt='浏览' title='浏览'>
			 <img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16">
			 </a>&nbsp;&nbsp;
			 <a href='<?php echo site_url('product/edit/bookID/'.$value['bookID'])?>' style="text-decoration:none" alt='编辑' title='编辑'>
			 <img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16">
			 </a>&nbsp;&nbsp;
			 <a href='#' id="in_recycle" style="text-decoration:none"  title='放入回收站' onclick="in_recycle('<?php echo $value['bookID']?>',this)">
			 <img src="<?php echo base_url()?>images/icon_trash.gif" border="0" width="16" height="16" alt='放入回收站'>
			 </a>
			</div></td>
		  </tr>
		  <?php
		  } 
		  ?>
		</tbody></table>
		</div>
		<!-- 分页显示 -->
		<?php
		print_r($temp); 
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
		//$this->load->view('widget/pagination', $data)
	    ?>
		<!-- /分页显示 -->
		</div><!-- /内容 -->	   
  </div></div></div></div></div></div></div>
  <!-- /菜单体 --> 
</div>
</body>
</html>

