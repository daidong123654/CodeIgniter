<?php
/*
 * Created on 2012-9-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates

 
 $db_host = $_POST['Hostname'];
 $db_user = $_POST['DBMSUserName'];
 $db_pass = $_POST['DBMSPassword'];
// $db_name = $_POST[''];
 
 define('MCBOOKINSTALLED',true);
 define('TABLE_PREFIX'," lib_");
 $db_link = mysql_connect("$db_host","$db_user","$db_pass") or die("不能连接数据库！".mysql_error());
 if($db_link){
 	echo "连接数据库成功！<br/>";
 	echo $db_link."<br/>";
 }
 $sql="create database  library";
 mysql_query($sql,$db_link);
 $db=mysql_select_db($db_name,$db_link);
 echo $db;
 
 $library="create table  lib_ library (id int(10) AUTO_INCREMENT primary key, libraryName varchar(50), libraryCurator varchar(10),Telephone varchar(20),Email varchar(100),Address varchar(100),Url varchar(100),BuildingDate date,Intruction text)";
 mysql_query($library,$db_link);
 mysql_error();
 
 $manager="create table lib_manager (mid int(10) AUTo_INCREMENT primary key, Mname varchar(50),Mpass varchar(200),PowerLevel tinyint(2))";
 mysql_query($manager,$db_link);
mysql_error();

 $settings="create table lib_setting (sid int(10) AUTO_INCREMENT primary key, TipsMoney int(10),validity int(10))";
 mysql_query($settings,$db_link);
 mysql_error();
 
 $booktype="create table lib_bookTypes(typeid int(10) AUTO_INCREMENT primary key,typename varchar(30),AvailableDays int(10) unsigned)";
 mysql_query($booktype,$db_link);
 mysql_error();
 
 $bookrack="create table  lib_bookrack (rackid int(10) AUTO_INCREMENT primary key,rackname varchar(20),racklocation varchar(30))";
 mysql_query($bookrack,$db_link);
 mysql_error();
 
 $bookinfo="create table lib_book(barcode varchar(30) primary key,bookname varchar(70),booktype int(10) unsigned,author varchar(30),translator varchar(30),ISBN varchar(20),price float(8) ,page int(10) unsigned,keywords varchar(30),bookrack int(10) unsigned,storge int(10),publishtime date,inTime date,operatorid int(10),ifdelete tinyint(1),bookid int(11))";
 mysql_query($bookinfo,$db_link);
mysql_error();
$borrow="create table lib_borrow (borrowid int(20) unsigned primary key,bookid int(10),borrowtime date,returntime date,operatorid int(10),isreturn tinyint(1))";
mysql_query($borrow,$db_link);
mysql_error();

$power ="create table lib_power (mid int(10) primary key,systemsetting tinyint(1),readermangement tinyint(1),booksmanagement tinyint(1),borrowandreturn tinyint(1),systemsearching tinyint(1))";
mysql_query($power,$db_link);
mysql_error();

$giveback="create table lib_giveback(rid int(10) AUTO_INCREMENT primary key, readerid int(11),bookid int(11),returntime date,opreatorid int(10))";
mysql_query($giveback,$db_link);
mysql_error();

$publishing="create table lib_publishing(ISBN varchar(30),ISBNname varchar(30))";
mysql_query($publishing,$db_link);
mysql_error();

$reader="create table lib_reader(readerid int(10) AUTO_INCREMENT primary key,name varchar(20),sex varchar(4),readerbarcode varchar(30),birthday date,papertype varchar(10),papercode varchar(30),readertelephone varchar(20),readerEmail varchar(100),registrationdate date,opreatorid int(10),remark text,credit int(10),typeid int(11))";
mysql_query($reader,$db_link);
mysql_error();

$readertype="create table lib_readertype(readerTypeid int(10) unsigned , readerTypename varchar(50),numberdays tinyint(4))";
mysql_query($reader,$db_link);
mysql_error();

$opreator="create table lib_opreator(opreatorid int(10) AUTO_INCREMENT primary key,name varchar(30),IDcode varchar(20),address varchar(100),startworkingtime date)";
mysql_query($opreator,$db_link);
mysql_error();
?>

*/

?>
