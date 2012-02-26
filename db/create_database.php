<?php
//connetct to the DB

$link = mysql_connect("localhost","root","") 
		or die("Could not connect" . mysql_error());
		
mysql_select_db("bookmarks", $link) or die (mysql_error());

//create b_sites table

$sql  = "CREATE TABLE IF NOT EXISTS b_sites (
		 bid int(11) NOT NULL AUTO_INCREMENT, INDEX (bid),
		 b_url varchar(255),
		 b_title varchar(255),
		 b_desc varchar(255),
		 catid int(11),
		 userid int(11)
		 )";
$results = mysql_query($sql) or die(mysql_error());
if($results){
	echo "b_sites table successfully created!<br>";
}else {
	echo "b_sites table creation failed...";
}
// create b_categories table

$sql1 = "CREATE TABLE IF NOT EXISTS b_categories (
		 catid int(11) NOT NULL AUTO_INCREMENT, INDEX (catid),
		 catname varchar(255)
		 )";
		 
$results1 = mysql_query($sql1) or die(mysql_error());
if($results1){
	echo "b_categories table successfully created!<br>";
}else {
	echo "b_categories table creation failed...";
}
//create b_users  table

$sql2 = "CREATE TABLE IF NOT EXISTS b_users (
		 userid int(11) NOT NULL AUTO_INCREMENT,
		 u_nick varchar(11),
		 u_names varchar(30),
		 u_password varchar(30),
		 primary key(userid)
		 )";

$results2 = mysql_query($sql2) or die(mysql_error());
if($results2){
	echo "b_users table successfully created!<br>";
}else {
	echo "b_users table creation failed...";
}

//create b_ugroups table

$sql3 = "CREATE TABLE IF NOT EXISTS b_ugroups (
		 ug_id int(11) NOT NULL AUTO_INCREMENT,
		 ug_name varchar(25),
		 primary key(ug_id)
		 )";
$results3 = mysql_query($sql3) or die(mysql_error());
if($results3){
	echo "b_ugroups table successfully created!<br>";
}else {
	echo "b_ugroups table creation failed...";
}
?>