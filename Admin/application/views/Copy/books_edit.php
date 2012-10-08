<?php
/*
 * Created on 2012-10-7
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
<!--

//窗口大小调整
$(document).ready(function() {
  editBody();
});
$(window).resize(function(){
  editBody();
});
// 选项卡
$(document).ready(function() {
  $('#tabbar').find('span').each(function(column) {
	  $(this).hover(function() {
        $(this).removeClass('tab-back').addClass('tab-hover');
      }, function() {
		if ($(this).hasClass("tab-front")){
          $(this).removeClass('tab-hover');
		}else{
          $(this).removeClass('tab-hover').addClass('tab-back');
		}
      }).click(function() {
		$(this).siblings('span').removeClass().addClass('tab-back')
		  .end().removeClass().addClass('tab-front');
        objDiv = this.id.substring(0, this.id.lastIndexOf("-")) + "-div";
		$('#'+objDiv).show();
		$('#'+objDiv).siblings('.tab-div').hide();
      });
  });
})

// 特价日期
$(document).ready(function() {  
  var edit_special_price = function() {
	$('#is_special_price').each(function(){
	  if (this.checked) {
        $('#special_price,#selbtn1,#selbtn2').attr('disabled',false);
		$('#special_price').removeClass('x-form-invalid');
	  }
	});
    $('#is_special_price').click(function(){ 
	  if (this.checked) { 
	    $('#special_price,#selbtn1,#selbtn2').attr('disabled',false);	  
	  }else{
        $('#special_price,#selbtn1,#selbtn2').attr('disabled',true);
		$('#special_price,#special_price_end_at,#special_price_start_at').val('');
		$('#special_price').removeClass('x-form-invalid');
	  }
    });
  };
  edit_special_price();
});


$(document).ready(function() {

  $('#name').focus();

  var reAdd = function(){
    window.location.href= "<?php echo site_url('product/edit')?>";
  }

  var showTab = function(){
	  $('#tabbar').find('span').removeClass().addClass('tab-back');
	  $('#basic-tab').removeClass().addClass('tab-front');
	  $('#basic-div').show().siblings('.tab-div').hide();
  }
  
  var ID = "<?php echo $editing['id']?>";

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

//无刷切换属性分组
$(document).ready(function() {
  $('#attr_set').change(function(){
	$.post(
		'<?php echo site_url('product/build_attr_html')?>', 
		$('#form').serialize(),
		function(data){
		$('#attr_list').empty();
		if(data==1){
		  //load nothing
		}else{
          $(data).appendTo($('#attr_list'));
		}
	});
  });
});

//无刷删除图片
$(document).ready(function() {
  $('.del_image').click(function(){
	image = $(this);
	if (confirm('确定删除？')){
	  $.ajax({
	    url: '<?php echo site_url('product/del_image')?>'+'/image_id/'+$(this).val(),
	    success: function(data){
	      image.parents('tr:first').remove();
	    }
	  });
	}else{
        image.attr('checked','');
	}
  });
});

//无刷更换主图
$(document).ready(function() {
  $('.main_image').click(function(){
	image = $(this);
	$.ajax({
	url: '<?php echo site_url('product/base_image')?>'+'/image_id/'+image.val(),
	  success: function(data){
	      //
	  }
	});
  });
});


//动态增删上传文件域
var tr = '<tr height="10"></tr><tr ><td class="image_del" onClick="image_del(this)"><img src="<?php echo base_url()?>images/no.gif" /></td><td><input type="file" name="file[]" /></td></tr>';
$(document).ready(function() {
  $('#image_add').click(function(){	
	$(this).parents('table').append(tr);
  });
  image_del = function(obj)
  {
    $(obj).parents('tr:first').prev('tr').andSelf().remove();
  }
});


//-->
</script>
</head>
<body class="x-border-layout-ct" style="position: relative;" >
<div id="msg"></div>
<div id="main-tabs" class="x-tab-panel x-border-panel" style="left: 5px; top: 0px; ">

    <!-- 当前菜单 -->
    <div style="-moz-user-select: none; " id="crt-menu" class="x-tab-panel-header x-unselectable">
    <div class="x-tab-strip-wrap">
    <ul  class="x-tab-strip x-tab-strip-top">
    <li class="x-tab-strip-active" >
    <a class="x-tab-right" href="#" onClick="return false;">
    <em class="x-tab-left">
    <span style="width: 130px;" class="x-tab-strip-inner">
    <span class="x-tab-strip-text"><?php echo $header_text; ?></span>
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

	<td  onClick="window.location.href='<?php echo site_url('product')?>'"><table   class="x-btn-wrap x-btn x-btn-text-icon button" border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	<td class="x-btn-left"><i>&nbsp;</i></td>
	<td class="x-btn-center"><em ><button  class="x-btn-text tb-owner" type="button">列表</button></em></td>
	<td class="x-btn-right"><i></i></td>
	</tr></tbody></table></td>

	</tr></tbody></table></div></div>
    <!-- /工具栏 -->
	<!-- 表单 -->
	<div id="menu-body" class="x-panel-body x-panel-body-noheader x-panel-body-noborder x-border-layout-ct " style="overflow:auto">

	  <div  class="x-panel x-panel-noborder" style="padding: 10px 10px 0px;">
	  <div  class="x-panel-bwrap">
	  <div  class="x-panel-body x-panel-body-noheader x-panel-body-noborder ">
	  <div class="bottomLine" id="tabbar" >
	  <font class="lineTitle" >
	  <span class="tab-front" id="basic-tab" >基本信息</span>

	  <span class="tab-back" id="desc-tab" >描述</span>

	  <span class="tab-back" id="meta-tab">Meta</span>

	  <span class="tab-back" id="imgs-tab">图片</span>

	  <span class="tab-back" id="attr-tab">商品属性</span>
      
	  <!--<?php if ($editing['id']){ ?>
	  <span class="tab-back" ><a href='<?php echo site_url('product/related/id/'.$editing['id'])?>' style="text-decoration:none" alt='关联商品' title='关联商品'>商品关联</a></span>
      <?php  }?>-->

      </font>
	  </div>
	  </div>
	  </div>
	  </div>

	  <div  class="x-panel x-form-label-left " >
	  <div  class="x-panel-bwrap form-padding"> 
	  <form style="padding: 5px 5px 0pt; width: ;" class=" x-form" method="post" action="<?php echo site_url('product/save')?>"  id="form" enctype="multipart/form-data" >
	  <input  name="re_edit" id="re_edit" type="hidden" value="0" >
	  <input name="id" id="id" type="hidden" value="<?php echo $editing['bookID']?>" />
      
	  <div id="basic-div" class="tab-div" style="display:block">
		  
		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">商品名称:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <input style="width: 222px;" class="x-form-text x-form-field x-form-required" size="20"  name="name" id="name" type="text" value="<?php echo $editing['bookname']?>" >
		  </div>
		  <div class="x-form-clear-left"></div>
	      </div>

		 

		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">商品分类:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <select name='cat_id'  style="width:230px;height:22px;">
		  <option value='0'  >请选择...</option>
		  <?php foreach($categorys as $value) :  ?>
		  <option value='<?php echo $value['id'];  ?>' <?php  if($value['id']==$editing['cat_id']) echo 'selected=selected'?>  ><?php for($i=1;$i<=$value['level'];$i++){ echo '&nbsp;&nbsp;&nbsp;&nbsp;';} ?><?php echo $value['name'];  ?></option>
		  <?php endforeach; ?>
		  </select>
		  </div>
		  <div class="x-form-clear-left"></div>
		  </div>

		  

		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">商品品牌:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <select name='brand_id'  style="width:230px;height:22px;">
		  <option value='0'  >请选择...</option>
		  <?php foreach($brands as $value) :  ?>
		  <option value='<?php echo $value['id'];  ?>' <?php  if($value['id']==$editing['brand_id']) echo 'selected=selected'?>  ><?php echo $value['name'];  ?></option>
		  <?php endforeach; ?>
		  </select>
		  </div>
		  <div class="x-form-clear-left"></div>
		  </div>

		 

		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">库存:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <input style="width: 222px;" class="x-form-text x-form-field  x-form-num" size="20"  name="stock" id="stock" type="text" value="<?php echo $editing['storge']?>" >
		  </div>
		  <div class="x-form-clear-left"></div>
	      </div>

		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">销售价格:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <input style="width: 222px;" class="x-form-text x-form-field  x-form-num" size="20"  name="price" id="price" type="text" value="<?php echo $editing['price']?>" >
		  </div>
		  <div class="x-form-clear-left"></div>
	      </div>

		  <div class="x-form-item" >
		  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">市场价格:</label>
		  <div class="x-form-element"  style="padding-left: 80px;">
		  <input style="width: 222px;" class="x-form-text x-form-field x-form-num" size="20"  name="market_price" id="market_price" type="text" value="<?php echo $editing['price']?>" >
		  </div>
		  <div class="x-form-clear-left"></div>
	      </div>
		 

		 

		 

		 
      </div>

	  
	 

	  

	  <div id="attr-div" class="tab-div" style="display:none">
	      <div class="x-form-item" >
		  <label  style="width: 85px;color:dimgray;" class="x-form-item-label"></label>
		  <div class="x-form-element" id="" style="padding-left: 80px;">
		  <select id="attr_set" name='attr_set_id'  style="height:22px;" >
		  <option value='0' >请选择属性分组</option>
		  <?php foreach($attribute_sets as $value) :  ?>
		  <option value='<?php echo $value['id'];  ?>' <?php  if($value['id']==$editing['attr_set_id']) echo 'selected=selected'?>  ><?php echo $value['name'];  ?></option>
		  <?php endforeach; ?>
		  </select>
		  </div>
		  <div class="x-form-clear-left"></div>
		  </div><br/>
		  
		  
	  </div>

	  </form>
      </div>
      </div>

  </div>
    <!-- /表单 -->

</div>
</body>
</html>