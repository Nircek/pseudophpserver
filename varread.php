<?php
//# varread.php # (name=var, user=user) + admin
/*
PSF

read var

*/
$flog=true;
require_once "log.php";
flog("varread.php started");

if(!isset($_GET['name'],$_GET['user'])){
	echo -1;
	flog("ERR: -1");
	exit;
}
require "admin.php";
require_once "mysql.php";
DBC::get() = @new mysqli($db_host,$db_user,$db_pass,$db_table);
if(DBC::get()->connect_errno!=0){
	echo "+";
	echo DBC::get()->connect_errno."\xB2".DBC::get()->connect_error;
	flog("ERR: ".DBC::get()->connect_error.'('.DBC::get()->connect_errno.')');
	exit;
}
DBC::get()->set_charset("utf8");
$result=DBC::get()->query(sprintf("SELECT * FROM `vars` WHERE `user`='%s' AND `name`='%s'",
mysqli_real_escape_string(DBC::get(),$_GET['user']),
mysqli_real_escape_string(DBC::get(),$_GET['name'])));
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
echo $result->fetch_assoc()['value'];


flog("varread.php stopped");
?>
