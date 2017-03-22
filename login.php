<?php
//# login.php #
/*
PPSF

sprawdza, czy dane podane przez użytkownika są prawidłowe

*/

if(!isset($_GET['user'],$_GET['pass'])){
	echo -2;
	exit;
}
require_once "mysql.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno."".$connection->connect_error;
	exit;
}
$connection->set_charset("utf8");
$result=$connection->query(sprintf("SELECT * FROM `users` WHERE `user`='%s' AND `pass`='%s'",
mysqli_real_escape_string($connection,$_GET['user']),
mysqli_real_escape_string($connection,$_GET['pass'])));
if($result->num_rows===0){
	echo -2;
	exit;
}
$connection->close();
?>
