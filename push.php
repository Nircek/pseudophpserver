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
$result = DBC::get()->query(sprintf(
"INSERT INTO `psqueue`(`id`,`user`,`name`) VALUES ('','%s','%s')",
mysqli_real_escape_string(DBC::get(),$_GET['user']),
mysqli_real_escape_string(DBC::get(),$_GET['event'])
));
if(!$result) {
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
}
echo 0;
flog("push.php stopped");
exit;
?>
