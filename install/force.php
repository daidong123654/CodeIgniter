<?php

	$link=mysql_connect('localhost','root','daidong','library')or die("连接数据库失败".mysql_error());//连接数据库
	mysql_select_db('library');	
	$un="SELECT * FROM lib_manager WHERE Mname = 'admin'";
	$result=mysql_query($un,$link);
	$row=mysql_num_rows($result);

			$pass = md5(111111);
			$sql="insert into lib_manager( Mname,Memail,Mpass,role_id) values ('admin','daidong123654@126.com','$pass','1')";
			mysql_query($sql,$link)
			
 
?>

