<?php
/*
 * Created on 2012-10-15
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/calendar.php"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script language="JavaScript"> var base_url = '<?php echo base_url()?>'; </script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/admin.js"></script>


<script language="JavaScript"> 
//窗口大小调整
$(document).ready(function() {
  editBody();
});
$(window).resize(function(){
  editBody();
});

$(document).ready(function() {

  $('#name').focus();

  var reAdd = function(){
    window.location.href= "<?php echo site_url('borrow/edit')?>";
  }

  var showTab = function(){
	  $('#tabbar').find('span').removeClass().addClass('tab-back');
	  $('#basic-tab').removeClass().addClass('tab-front');
	  $('#basic-div').show().siblings('.tab-div').hide();
  }
  
  

  $('#save').click(function() {//新增
    if (beforeSubmit()){
	  $('form').submit();
    }else{
      showTab();
	}
  });

  $('#saveEdit').click(function() {//新增并继续编辑
	if (beforeSubmit()){
      $('#re_edit').val('1');   
	  $('form').submit();
	}else{
      showTab();
	}
  });
});


</script>
</head>
<body class="x-border-layout-ct" style="position: relative;" >
<div id="msg"></div>
<div id="main-tabs" class="x-tab-panel x-border-panel" style="left: 5px; top: 0px; width:100%;">

    <!-- 当前菜单 -->
    <div style="-moz-user-select: none; " id="crt-menu" class="x-tab-panel-header x-unselectable">
    <div class="x-tab-strip-wrap">
    <ul  class="x-tab-strip x-tab-strip-top">
    <li class="x-tab-strip-active" >
    <a class="x-tab-right" href="#" onClick="return false;">
    <em class="x-tab-left">
    <span style="width: 130px;" class="x-tab-strip-inner">
    <span class="x-tab-strip-text">添加借阅</span>
    </span>
    </em>
    </a>
    </li>
    <li  class="x-tab-edge"></li>
    <div  class="x-clear"></div>
    </ul>
    </div>
    </div>

    <!-- 工具栏 -->
    <div id="tool" class="x-panel-tbar x-panel-tbar-noheader"><div  class="x-toolbar "><table cellspacing="0"><tbody><tr>
	
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

	<td><span  class="ytb-sep"></span></td>

	<td  onClick="window.location.href='<?php echo site_url('borrow')?>'"><table   class="x-btn-wrap x-btn x-btn-text-icon button" border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	<td class="x-btn-left"><i>&nbsp;</i></td>
	<td class="x-btn-center"><em ><button  class="x-btn-text tb-owner" type="button">列表</button></em></td>
	<td class="x-btn-right"><i></i></td>
	</tr></tbody></table></td>

	</tr></tbody></table></div></div>
    <!-- /工具栏 -->
	
	<!-- 表单 -->
	<div id="menu-body" class="x-panel-body x-panel-body-noheader x-panel-body-noborder x-border-layout-ct " >
	  <div  class="x-panel x-panel-noborder" style="padding: 10px 10px 0px;">
	  <div  class="x-panel-bwrap">
	  <div  class="x-panel-body x-panel-body-noheader x-panel-body-noborder ">
	  <div class="bottomLine" id="tabbar" >
	  <font class="lineTitle" >
	  <span class="tab-front" id="basic-tab" >基本信息</span>
      </font>
	  </div>
	  </div>
	  </div>
	  </div>

	  <div  class="x-panel x-form-label-left " >
	  <div  class="x-panel-bwrap form-padding"> 
	  <form style="padding: 5px 5px 0pt; width: ;" class=" x-form" method="post" action="<?php echo site_url('borrow/save')?>"  id="form" enctype="multipart/form-data" >	  
	 
      
	  <div id="basic-div" class="tab-div" style="display:block">
		  
		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">图书ID:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <input style="width: 222px;" class="x-form-text x-form-field x-form-required" size="20"  name="bookID" id='bookID' type="text"  >
		  </div>
		  <div class="x-form-clear-left"></div>
	      </div>
		  
		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">读者ID:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <input style="width: 222px;" class="x-form-text x-form-field x-form-required" size="20"  name="reader" id='reader' type="text"  >
		  </div>
		  <div class="x-form-clear-left"></div>
	      </div>
		  
		 	  
      </div>
	</form>
      </div>
      </div>
  </div>
    <!-- /表单 -->

</div>
</body>
</html>