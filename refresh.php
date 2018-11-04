<?php
//# refresh.php # () + login
/*
PCF

refresh data from server

*/
$flog=true;
require_once "log.php";
flog("refresh.php started");
require_once "login.php";
require_once "mysql.php";
$result=DBC::get()->query(sprintf("SELECT * FROM `pcqueue` WHERE `user`='%s'",
mysqli_real_escape_string(DBC::get(),$_GET['user'])));
if(!$result){
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
}
if(($result->num_rows)<1){
	echo -5;
	flog("ERR: -5");
	exit;
}
echo 0;
echo $result->fetch_assoc()['text'];
flog("refresh.php stopped");
exit;
?>
