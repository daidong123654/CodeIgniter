<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link href="<?php echo base_url()?>css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/main.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script language="JavaScript"> var base_url = '<?php echo base_url()?>'; </script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/admin.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/bootstrap.js"></script>
<script language="JavaScript"> 

$(document).ready(function() {
  listBody();
});
$(window).resize(function(){
  listBody();
});

function delete_a(id)
{
	if (confirm('确定删除该管理员吗？')){
   
	window.location.href= '<?php echo site_url('admin_user/delete/id')?>'+'/'+id;
    }
}

</script>


</head>
<body class=" x-border-layout-ct" style="position: relative;">


 <div id="crt-menu" class="x-tab-panel-header x-unselectable">
 <div  id="crt-menu1" class="x-tab-strip-wrap">
 <ul id="crt-menu2" class="x-tab-strip x-tab-strip-top">
 <li class="x-tab-strip-active" >
 <a class="x-tab-right" href="#" onClick="return false;">
 <em class="x-tab-left">
 <span style="width: 130px;" class="x-tab-strip-inner">
 <span class="x-tab-strip-text">管理员列表</span>
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
   <div id="tool" class="x-panel-tbar x-panel-tbar-noheader"><div class="x-toolbar " style="border-left:0 solid #99bbe8;"><table cellspacing="0"><tbody><tr>
	
	 <td onClick="window.location.href='<?php echo site_url('admin_user/add')?>'"><table style="width: hidden;" class="button x-btn-wrap x-btn x-btn-text-icon " border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	 <td class="x-btn-left"><i>&nbsp;</i></td>
	 <td class="x-btn-center" ><em ><button class="x-btn-text tb-addnew" type="button" >新增</button></em></td>
	 <td class="x-btn-right"><i></i></td>
	 </tr></tbody></table></td>

	 </tr></tbody></table></div></div>
	 <!-- /工具栏 -->

<div class="list-div" id="listDiv" >
<table class="table table-striped " cellpadding="3" cellspacing="0" id="listTable" style="width:100%">
<tr>
<!--<button class="btn btn-large btn-block" type="button" >-->
	<th>用户名</th>
	<th>角色</th>
	<th>Email地址</th>
	<th>加入时间</th>
	<th>最后登录时间</th>
	<th>操作</th>
</button>
</tr>
<?php
    foreach ($admin_users as $value)
 	{
	?>
	<!--<button class="btn btn-large btn-block" type="button" >-->
		<tr>		
			<td><?php echo $value['Mname'];?></td> 
			<td><?php echo$value['role_name'];?></td>
			<td><?php echo$value['Memail'];?></td>
			<td><?php echo$value['CreateDate'];?>
			<td>待定</td>
			<td ><div class="x-grid3-cell-inner ">
			 <a href='<?php echo site_url('admin_user/edit/id/'.$value['mID'])?>' style="text-decoration:none" alt='编辑' title='编辑'>
			 <img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16">
			 </a>&nbsp;&nbsp;
			  <a href='#' onclick="delete_a('<?php echo $value['mID'];?>')" style="text-decoration:none" alt='删除' title='删除'>
			 <img src="<?php echo base_url()?>images/icon_drop.gif" border="0" width="16" height="16">
			 </a>
			</div></td>
		
		</tr>
	<!--</button>-->
	<?php	
 	}		
?>

</table>
</div>
</body>
</html>