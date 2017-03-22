<?php
//# push.php #
/*
PCF

dodaje wydarzenie do kolejki wydarzeń

*/
if(!isset($_GET['event'])){
	echo -1;
	exit;
}
require_once "mysql.php";
require_once "login.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno."".$connection->connect_error;
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
	echo $connection->errno."".$connection->error;
	exit;
}

$connection->close();
echo 0;
exit;
?>
