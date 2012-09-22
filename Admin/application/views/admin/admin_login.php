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


<form class="form-horizontal" action="<?=base_url()?>index.php/admin/checkAdminLogin" method="post">
	<div class="control-group"> 	
		<label class="control-label" for="adminname">Admin Name：</label>
		<div class="controls">			
			<input id="inputSuccess" type="input" name="AdminName" />
		</div>
	</div>

	<div class="control-group"> 	
		<label class="control-label" for="adminpass">Admin Pass：</label>
		<div class="controls">			
			<input id="inputSuccess" type="password" name="AdminPassword" />
		</div>
	</div>
	
	<div class="control-group"> 			
		<div class="controls">			
			<input class="btn btn-success" type=submit name="submit" value="Admin Login"/>
		</div>
	</div>

</form>