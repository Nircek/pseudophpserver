<?php
//# reply.php #
/*
PSF

odpowiada do klienta

*/
if(!isset($_GET['text'],$_GET['user'])){
	echo -1;
	exit;
}
require "admin.php";
require_once "mysql.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno;
	exit;
}
$connection->set_charset("utf8");

$result=$connection->query(sprintf("SELECT * FROM pcqueue WHERE `user`='%s'",
mysqli_real_escape_string($connection,$_GET['user'])));
if(!$result){
	echo "+";
	echo $connection->errno."".$connection->error;
	exit;
}
if($result->num_rows>0){
	$result = $connection->query(sprintf("UPDATE pcqueue SET `text`='%s' WHERE `user`='%s'",
		mysqli_real_escape_string($connection,$_GET['text']),
		mysqli_real_escape_string($connection,$_GET['user'])));
	if(!$result){
	echo "+";
	echo $connection->errno."".$connection->error;
	exit;
	}
}else{
	$result = $connection->query(sprintf("INSERT INTO pcqueue (`user`,`text`) VALUES('%s','%s')",
	mysqli_real_escape_string($connection,$_GET['user']),
	mysqli_real_escape_string($connection,$_GET['text'])
	));
	if(!$result){
	echo "+";
	echo $connection->errno."".$connection->error;
	exit;
}
}
if(!$result){
	echo "+";
	echo $connection->errno;
	exit;
}

$connection->close();
echo 0;
exit;


?>
