<?php
//# varread.php #
/*
PSF

odczytuje zmienną

*/
$flog=true;
require_once "log.php";
flog("varread.php started");

if(!isset($_GET['name'],$_GET['user'])){
	echo -1;
	flog("ERR: -1");
	exit;
}
require "admin.php";
require_once "mysql.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno."".$connection->connect_error;
	flog("ERR: ".$connection->connect_error.'('.$connection->connect_errno.')');
	exit;
}
$connection->set_charset("utf8");
$result=$connection->query(sprintf("SELECT * FROM `vars` WHERE `user`='%s' AND `name`='%s'",
mysqli_real_escape_string($connection,$_GET['user']),
mysqli_real_escape_string($connection,$_GET['name'])));
if(!$result){
	echo "+";
	echo $connection->errno."".$connection->error;
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
echo $result->fetch_assoc()['value'];


flog("varread.php stopped");
?>
