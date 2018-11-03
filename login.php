<?php
//# login.php #
/*
PPSF

check if user's login data is correct

*/
$flog=true;
require_once "log.php";
if(!isset($_GET['user'],$_GET['pass'])){
	echo -2;
	flog("ERR: User denied");
	exit;
}
require_once "mysql.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno."\x12".$connection->connect_error;
	flog("ERR: ".$connection->connect_error.'('.$connection->connect_errno.')');
	exit;
}
$connection->set_charset("utf8");
$result=$connection->query(sprintf("SELECT * FROM `users` WHERE `user`='%s' AND `pass`='%s'",
mysqli_real_escape_string($connection,$_GET['user']),
mysqli_real_escape_string($connection,$_GET['pass'])));
if($result->num_rows===0){
	echo -2;
	flog("ERR: User denied");
	exit;
}
$connection->close();
flog("User granted");
?>
