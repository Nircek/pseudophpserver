<?php
//# varwrite.php #
/*
PSF

set var

*/
$flog=true;
require_once "log.php";
flog("varwrite.php started");

if(!isset($_GET['name'],$_GET['user'],$_GET['value'])){
	echo -1;
	flog("ERR: -1");
	exit;
}
require "admin.php";
require_once "mysql.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno."\x12".$connection->connect_error;
	flog("ERR: ".$connection->connect_error.'('.$connection->connect_errno.')');
	exit;
}
$connection->set_charset("utf8");

$result=$connection->query(sprintf("SELECT * FROM vars WHERE `user`='%s' AND `name`='%s'",
mysqli_real_escape_string($connection,$_GET['user']),
mysqli_real_escape_string($connection,$_GET['name'])));
if(!$result){
	echo "+";
	echo $connection->errno."\x12".$connection->error;
	flog("ERR: ".$connection->error.'('.$connection->errno.')');
	exit;
}
if($result->num_rows>0){
	$result = $connection->query(sprintf("UPDATE vars SET `value`='%s' WHERE `user`='%s' AND `name`='%s'",
		mysqli_real_escape_string($connection,$_GET['value']),
		mysqli_real_escape_string($connection,$_GET['user']),
		mysqli_real_escape_string($connection,$_GET['name'])));
	if(!$result){
	echo "+";
	echo $connection->errno."\x12".$connection->error;
	flog("ERR: ".$connection->error.'('.$connection->errno.')');
	exit;
	}
}else{
	$result = $connection->query(sprintf("INSERT INTO vars (`user`,`name`,`value`) VALUES('%s','%s','%s')",
	mysqli_real_escape_string($connection,$_GET['user']),
	mysqli_real_escape_string($connection,$_GET['name']),
	mysqli_real_escape_string($connection,$_GET['value'])
	));
	if(!$result){
	echo "+";
	echo $connection->errno."\x12".$connection->error;
	flog("ERR: ".$connection->error.'('.$connection->errno.')');
	exit;
}
}
if(!$result){
	echo "+";
	echo $connection->errno."\x12".$connection->error;
	flog("ERR: ".$connection->error.'('.$connection->errno.')');
	exit;
}

$connection->close();
echo 0;
flog("varwrite.php stopped");
exit;
?>
