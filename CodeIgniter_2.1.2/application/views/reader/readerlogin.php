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
<form action="<?=base_url()?>/index.php/reader/readerlogin" method="post">


<center>
<ul style="list-style:none">
<p>
<label for="title">用户名:<input id="inputSuccess" type="input" name="readername" ></label>
<br/>
<label for="title">密  码：<input id="inputSuccess" type="password" name="readerpass" /></label>

</p>
<li><input class="btn btn-success" name="login" type="submit" value="登  录"></li>
</ul>
</center>
</form>
</html>
