<?php
/*
 * Created on 2012-9-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 //print_r($_POST); 
 //echo $_POST['RootName'];
 
 
 	$username=$_POST['RootName'];
	$email=$_POST['RootEmail'];
	$password=$_POST['RootPassword'];
	$password1=$_POST['CRootPassword'];
	$name = $username;
	
	if(!$username|| !$email|| !$password|| !$password1)  //信息填写不完整
	{
		?>
		<script type="text/javascript">
			alert('信息填写不完整，请重新填写！');
			window.location.href="setuproot.php";			
		</script>
		<?php
		exit;
	}
 
 /*
 
if( empty($_post['RootPassword']) || empty($_post['RootName']) || empty($_post['RootEmail']) || empty($_post['CRootPassword']) ) 
{
	echo "<h1>信息填写不完整</h1>";
	header('setuproot.php');
	exit();
}
*/
elseif($password != $password1)
{
	?>
		<script type="text/javascript">
			alert('两次密码不相同！');
			window.location.href="setuproot.php";			
		</script>
		<?php
		exit;
} 
else
{
	$link=mysql_connect('localhost','root','daidong','library')or die("连接数据库失败".mysql_error());//连接数据库
	mysql_select_db('library');
	
	$un="SELECT * FROM lib_manager WHERE Mname = '$name'";
	$result=mysql_query($un,$link);
	$row=mysql_num_rows($result);
	//echo "$row";
		if($row > 0)
		{
			?>
			<script type='text/javascript'>
				alert('用户名重复！不能重复注册！');
				window.location.href="setuproot.php";				
			</script>
			<?php
			exit;
		}
		else
		{
			$pass = md5($password);
			$sql="insert into lib_manager( Mname,Memail,Mpass,role_id) values ('$name','$email','$pass','1')";
			if(mysql_query($sql,$link) )//执行插入操作
			{
				?>
					<script type='text/javascript'>
						alert('创建成功！');
						window.location.href="http://localhost/Library/Admin/index.php/login";				
					</script>
				<?php
			exit;
			}
			else
			{
				?>
					<script type='text/javascript'>
						alert('创建失败！'.<?php mysql_error() ?>);
						window.location.href="http://localhost/Library/Admin/index.php/login";				
					</script>
				<?php
			}
		}
		
}
 
?>
