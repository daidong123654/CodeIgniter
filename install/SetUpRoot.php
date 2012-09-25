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
<title>设置PureWeber图书馆管理系统</title>
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
	
	<h2 style="text-align:center">设置Pureweber图书馆管理系统</h2>
<div style="width:40%;margin-left:30%">
	<marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()" ><h3 style="text-align:center;font-family:隶书">Pureweber图书馆管理系统设置页面</h3></marquee>
</div>


<form class="form-horizontal" action="SETUP.php" method="post" name="setuproot">
  <div class="control-group">    
    <label class="control-label" for="RootName">用户名</label>
    <div class="controls">
      <input type="text" id="id" placeholder="用户名" name="RootName" onblur='checkname()' >
    </div>
  </div>
  
  <div class="control-group">    
    <label class="control-label" for="inputEmail">邮箱</label>
    <div class="controls">
      <input type="text" id="id" placeholder="Email" name="RootEmail" onblur='checkname()'>
    </div>
  </div>
  
  <div class="control-group">    
    <label class="control-label" for="RootPassword">密码</label>
    <div class="controls">
      <input type="password" id="id" placeholder="密码" name="RootPassword" onblur='checkname()'>
    </div>
  </div>
  
  <div class="control-group">    
    <label class="control-label" for="CRootPassword">再次确认密码</label>
    <div class="controls">
      <input type="password" id="id" placeholder="再次确认密码" name="CRootPassword" onblur='checkname()'>
    </div>
  </div>
  
  
  <div class="control-group">
    <div class="controls">      
      <button type="submit" class="btn btn-info" name="setup" id="id1">提   交</button>
    </div>
  </div>
  
</form>

</body>
</html>
