<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->	
	
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />	
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />	
    <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />	
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />	
    <link href="css/css.css" rel="stylesheet" type="text/css" />	
	<script src="js/bootstrap.js"></script> 
	<script src="js/bootstrap-carousel.js"></script> 
	 
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script language="JavaScript"> 
	$('body').off('.data-api');
	$('body').off('.alert.data-api');
	$(".btn.danger").button("toggle").addClass("fat");
	$("#myModal").modal()   ;                    // initialized with defaults
	$("#myModal").modal({ keyboard: false }) ;  // initialized with no keyboard
	$("#myModal").modal('show') ;               // initializes and invokes show immediately
	$('#myModal').on('show', function (e) {
    if (!data) return e.preventDefault() // stops modal from being shown
	})
	</script>
	
  </head>
  <body>    
	<h1 style="text-align:center;font-family:'隶书'">图书馆管理系统</h1>
	<button type="button" class="btn btn-primary" data-loading-text="Loading...">Loading state</button>
<div id="wrap">	
<div class="1111btn btn-large btn-block">




<div id="myCarousel" class="carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner">
    <div class="active item"><img src="01.jpg" alt=""></div>
    <div class="item"><img src="02.jpg" alt=""></div>
    <div class="item"><img src="03.jpg" alt=""></div>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>

<!-- Carousel
          ================================================== -->
          <section id="carousel">
            <div class="page-header">
              <h1>Carousel <small>bootstrap-carousel.js</small></h1>
            </div>

            <h2>Example carousel</h2>
            <p>The slideshow below shows a generic plugin and component for cycling through elements like a carousel.</p>
            <div class="bs-docs-example">
              <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="01.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>First Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="02.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>Second Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="03.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>Third Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>
            </div>










</body>
</html>