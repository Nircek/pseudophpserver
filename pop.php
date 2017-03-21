<?php
//# pop.php #
/*
PSF

odczytuje wydarzenie z kolejki wydarzeń

*/
require "admin.php";
require_once "mysql.php";
$connection = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if($connection->connect_errno!=0){
	echo "+";
	echo $connection->connect_errno;
	exit;
}
$connection->set_charset("utf8");
$result=$connection->query("SELECT * FROM `psqueue` ORDER BY `id` LIMIT 1");
if(!$result){
	echo "+";
	echo $connection->connect_errno;
	exit;
}
if(($result->num_rows)>0){
	$r=$result->fetch_assoc();
	$user=$r['user'];
	$r=$r['name'];
	$result=$connection->query("DELETE FROM `psqueue` ORDER BY `id` LIMIT 1 ");
	if(!$result){
		echo "+";
		echo $connection->connect_errno;
		exit;
	}
}else{
	echo -1;
	$connection->close();
	exit;
}
$connection->close();
echo 0;
echo $user;
echo "";
echo $r;
exit;

?>
