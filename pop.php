<?php
//# pop.php # () + admin
/*
PSF

pop event from event queue

*/
$flog=true;
require_once "log.php";
flog("pop.php started");
require "admin.php";
require_once "mysql.php";
$result=DBC::get()->query("SELECT * FROM `psqueue` ORDER BY `id` LIMIT 1");
if(!$result){
	echo "+";
	echo DBC::get()->errno."\x12".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
}
if(($result->num_rows)>0){
	$r=$result->fetch_assoc();
	$user=$r['user'];
	$r=$r['name'];
	$result=DBC::get()->query("DELETE FROM `psqueue` ORDER BY `id` LIMIT 1 ");
	if(!$result){
		echo "+";
		echo DBC::get()->errno."\x12".DBC::get()->error;
		flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
		exit;
	}
}else{
	echo -5;
	flog("ERR: -5");
	exit;
}
echo 0;
echo $user;
echo "\x12";
echo $r;
flog("pop.php stopped");
exit;

?>
