<?php
/*
 * Created on 2012-9-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<html>
<center><h1>这是登陆界面</h1></center>
<?php //echo base_url();?>
<form class="form-horizontal" action="<?=base_url()?>/index.php/reader/readerlogin" method="post">
	
	<div class="control-group"> 
		<label for="title" class="control-label">用户名:</label>
		<div class="controls">
			<input id="inputSuccess" type="input" name="readername" />
		</div>
	</div>
		
	<div class="control-group"> 	
		<label class="control-label" for="inputEmail">密  码：</label>
		<div class="controls">
			<input id="inputSuccess" type="password" name="readerpass" />
		</div>
	</div>
	
	
	<div class="controls">
      <label class="checkbox" name="remember">
        <input type="checkbox"> Remember me    
	  </label>
	   <a href="">忘记用户名或密码？</a><br/>    
    </div>
	<br/>
	<div class="controls">
		<input class="btn btn-success" name="login" type="submit" value="登  录">		
	</div>




</form>
</html>
