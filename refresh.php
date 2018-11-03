<?php
//# refresh.php #
/*
PCF

refresh data from server

*/
$flog=true;
require_once "log.php";
flog("refresh.php started");
require_once "login.php";
require_once "mysql.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno."\x12".$connection->connect_error;
	flog("ERR: ".$connection->connect_error.'('.$connection->connect_errno.')');
	exit;
}
$connection->set_charset("utf8");
$result=$connection->query(sprintf("SELECT * FROM `pcqueue` WHERE `user`='%s'",
mysqli_real_escape_string($connection,$_GET['user'])));
if(!$result){
	echo "+";
	echo $connection->errno."\x12".$connection->error;
	flog("ERR: ".$connection->error.'('.$connection->errno.')');
	exit;
}
if(($result->num_rows)<1){
	echo -5;
	$connection->close();
	flog("ERR: -5");
	exit;
}
echo 0;
echo $result->fetch_assoc()['text'];
flog("refresh.php stopped");
exit;
?>
