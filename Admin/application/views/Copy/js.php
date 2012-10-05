<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->	
	
    <link href="<?php echo base_url();?>/css/bootstrap.css" rel="stylesheet" type="text/css" />	
	
	<script language="javascript" src="<?php echo base_url();?>/js/jquery.js"></script>
	<script language="javascript" src="<?php echo base_url();?>/js/bootstrap.js"></script>
	<script language="javascript" src="<?php echo base_url();?>/js/bootstrap-carousel.js"></script>
    
    <script language="javascript">
    	$('.carousel').carousel('cycle');
    	$('#myModal').modal({
    		backdrop:true,
    		keyboard:true,
    		show:true
		});
		$('#myModals').modal({
    		backdrop:true,
    		keyboard:true,
    		show:true
		});
		$('#myModalesc').modal({
    		backdrop:true,
    		keyboard:true,
    		show:true
		});
		$('#myModalesc').fade({
    		backdrop:true,
    		keyboard:true,
    		show:true
		});
	</script>		
	
	
  </head>
  <body>    
 
 <a class="btn" data-toggle="modal" href="#myModal" >点击触发对话框</a>
 <a class="btn" data-toggle="modal" href="#myModals" >s点击触发对话框</a>
 <a class="btn" data-toggle="modal" href="#myModalesc"  data-keyboard="false" data-backdrop="false" >点击"无ESC关闭，无遮蔽背景"演示</a>
 <a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
  
  <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>对话框标题</h3>
  </div>
  <div class="modal-body">
    <p>对话框内容</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">关闭</a>
    <a href="#" class="btn btn-primary">保存更新</a>
  </div>
</div>

 <div class="modal" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>对话框标题s</h3>
  </div>
  <div class="modal-body">
    <p>对话框内容s</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">关闭</a>
    <a href="#" class="btn btn-primary">保存更新</a>
  </div>
</div>
  
 <div class="modal" id="myModalesc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>对话框标题esc</h3>
  </div>
  <div class="modal-body">
    <p>对话框内容esc</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">关闭</a>
    <a href="#" class="btn btn-primary">保存更新</a>
  </div>
</div> 
  
  
  
<div id="myCarousel" class="carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner">
    <div class="active item"><img src="<?php echo base_url()?>/images/01.jpg" alt=""></div>
    <div class="item"><img src="<?php echo base_url()?>/images/02.jpg" alt=""></div>
    <div class="item"><img src="<?php echo base_url()?>/images/03.jpg" alt=""></div>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>

 

</body>
</html>