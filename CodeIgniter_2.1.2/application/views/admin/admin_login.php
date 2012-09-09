<?php
/*
 * Created on 2012-9-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 //echo "This is admin_loginpage";
?>
<h2 style="text-align:center">Admin_login</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('admin/admin') ?>
<center>
<label for="title">AdminName:<?php echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';?><input id="inputSuccess" type="input" name="AdminName" /></label>

<br/>

<label for="title">AdminPassword:<input id="inputSuccess" type="password" name="AdminPassword" /></label>
<br/>

<input class="btn btn-success" type=submit name="submit" value="Admin Login"/>
</center>
</form>