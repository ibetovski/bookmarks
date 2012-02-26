<?php
//connetct to the DB
include("../lib/config.php");

//insert users
$nickname = 'iliyan';
$username = 'Илиян Бетовски';
$password= md5('1234');
echo $username . '<br>';
echo $password;

$sql  = "INSERT INTO b_users (`u_nick`, `u_names`, `u_password`) 
				  VALUES ('$nickname', '$username', '$password')";
$results = mysql_query($sql) or die(mysql_error());
if($results){
	echo "<br>User inserted successfully!<br>";
}else {
	echo "User insertion failed...";
}
?>