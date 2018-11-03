<?php
//# register.php #
/*
PCF

rejestracja nowego użytkownika

*/
$flog=true;
require_once "log.php";
flog("register.php started");

if(!isset($_GET['user'],$_GET['pass'])){
	echo -1;
	flog("ERR: -1");
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

$result=$connection->query(sprintf("SELECT * FROM users WHERE `user`='%s'",
mysqli_real_escape_string($connection,$_GET['user'])));
if(!$result){
	echo "+";
	echo $connection->errno."\x12".$connection->error;
	flog("ERR: ".$connection->error.'('.$connection->errno.')');
	exit;
}
if($result->num_rows>0){
	echo -6;
	flog("ERR: -6");
	exit;
}else{
	$result = $connection->query(sprintf("INSERT INTO users (`user`,`pass`) VALUES('%s','%s')",
	mysqli_real_escape_string($connection,$_GET['user']),
	mysqli_real_escape_string($connection,$_GET['pass'])
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
flog("register.php stopped");
exit;
?>
