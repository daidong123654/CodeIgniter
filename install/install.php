<?php
/*
 * Created on 2012-9-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<html>
<head>
<title>安装PureWeber图书馆管理系统</title>
<style>
#id{width:400px;height:30px;}
#id1{width:150px;height:30px;}
</style>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />	
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />	
    <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />	
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />	
    <link href="css/css.css" rel="stylesheet" type="text/css" />	
	<script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body style="background:#c3d5ed">
	
	<h2 style="text-align:center">安装Pureweber图书馆管理系统</h2>
<div style="width:40%;margin-left:30%">
	<marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()" ><h3 style="text-align:center;font-family:隶书">Pureweber图书馆管理系统安装页面</h3></marquee>
</div>


	<form class="form-horizontal" action="CreateDB.php" method="post" name="readerregisterform">
  <div class="control-group">    
    <label class="control-label" for="inputEmail">Hostname</label>
    <div class="controls">
      <input type="text" id="id" placeholder="Hostname" name="Hostname" onblur='checkname()' >
    </div>
  </div>
  
  <div class="control-group">    
    <label class="control-label" for="inputEmail">DBMSUserName</label>
    <div class="controls">
      <input type="text" id="id" placeholder="DBMSUserName" name="DBMSUserName" onblur='checkname()'>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="DBMSPassword">DBMSPassword</label>
    <div class="controls">
      <input type="password" id="id" placeholder="DBMSPassword" name="DBMSPassword" >
    </div>
  </div>  
  
  
  <div class="control-group">
    <div class="controls">      
      <button type="submit" class="btn btn-info" name="register" id="id1">Install LIBM</button>
    </div>
  </div>
  
</form>

</body>
</html>
