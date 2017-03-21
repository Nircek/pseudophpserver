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
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno;
	exit;
}
$connection->set_charset("utf8");
$result = $connection->query("INSERT INTO `psqueue`(`id`,`name`) VALUES ('','".$_GET['event']."')");
if($result){
	echo "+";
	echo $connection->connect_errno;
	exit;
}

$connection->close();
echo 0;
exit;
?>
