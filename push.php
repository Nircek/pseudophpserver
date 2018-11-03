<?php
//# push.php # (event=element) + login
/*
PCF

push event to event queue

*/
$flog=true;
require_once "log.php";
flog("push.php started");
if(!isset($_GET['event'])){
	echo -1;
	flog("ERR: -1");
	exit;
}
require_once "mysql.php";
require_once "login.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno."\x12".$connection->connect_error;
	flog("ERR: ".$connection->connect_error.'('.$connection->connect_errno.')');
	exit;
}
$connection->set_charset("utf8");
$result = $connection->query(sprintf(
"INSERT INTO `psqueue`(`id`,`user`,`name`) VALUES ('','%s','%s')",
mysqli_real_escape_string($connection,$_GET['user']),
mysqli_real_escape_string($connection,$_GET['event'])
));
if(!$result){
	echo "+";
	echo $connection->errno."\x12".$connection->error;
	flog("ERR: ".$connection->error.'('.$connection->errno.')');
	exit;
}

$connection->close();
echo 0;
flog("push.php stopped");
exit;
?>
