<?php
/*
 * Created on 2012-10-4
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 print_r($books);
?>
 <div style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" id="content" class="x-panel-body" >
	  <div class="list-div " id="listDiv" style="margin-bottom:20px;">	      
	  <table cellpadding="3" cellspacing="0" id="listTable" >		          
	  <tbody>
	  <?php  foreach ($books as $value){ ?>
	  <tr class="x-grid3-row " >
			<td><div class="x-grid3-cell-inner "><?php echo $value['bookID'] ?></div></td>
			<td ><div class="x-grid3-cell-inner " ><span onclick="listEdit(this, 'bookname', <?php echo $value['bookID'] ?>)"><?php echo $value['bookname']; ?></span></div></td>
			
			<td ><div class="x-grid3-cell-inner "><?php echo $value['booktypename'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><span onclick="listEdit(this, 'price', <?php echo $value['bookID'] ?>)" ><?php echo $value['price'] ?></span></div></td>
			<td ><div class="x-grid3-cell-inner "><span onclick="listEdit(this, 'stock', <?php echo $value['bookID'] ?>)"><?php echo $value['storge'] ?></span></div></td>
			<td ><div class="x-grid3-cell-inner ">
			
			<td ><div class="x-grid3-cell-inner ">
			 <a href='<?php echo site_url('product')?>' style="text-decoration:none" alt='浏览' title='浏览'>
			 <img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16">
			 </a>&nbsp;&nbsp;
			 <a href='<?php echo site_url('product/edit/id/'.$value['id'])?>' style="text-decoration:none" alt='编辑' title='编辑'>
			 <img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16">
			 </a>&nbsp;&nbsp;
			 <a href='#' id="in_recycle" style="text-decoration:none"  title='放入回收站' onclick="in_recycle('<?php echo $value['bookID']?>',this)">
			 <img src="<?php echo base_url()?>images/icon_trash.gif" border="0" width="16" height="16" alt='放入回收站'>
			 </a>
			</div></td>
		  </tr>
	  <?php  } ?>
	</tbody></table>
	</div>

	<!-- 分页显示 -->
	<?php
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

</div>