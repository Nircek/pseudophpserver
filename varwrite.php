<?php
//# varwrite.php # (name=var, user=user, value=value) + admin
/*
PSF

set var

*/
$flog=true;
require_once "log.php";
flog("varwrite.php started");

if(!isset($_GET['name'],$_GET['user'],$_GET['value'])){
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

$result=DBC::get()->query(sprintf("SELECT * FROM vars WHERE `user`='%s' AND `name`='%s'",
mysqli_real_escape_string(DBC::get(),$_GET['user']),
mysqli_real_escape_string(DBC::get(),$_GET['name'])));
if(!$result){
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
}
if($result->num_rows>0){
	$result = DBC::get()->query(sprintf("UPDATE vars SET `value`='%s' WHERE `user`='%s' AND `name`='%s'",
		mysqli_real_escape_string(DBC::get(),$_GET['value']),
		mysqli_real_escape_string(DBC::get(),$_GET['user']),
		mysqli_real_escape_string(DBC::get(),$_GET['name'])));
	if(!$result){
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
	}
}else{
	$result = DBC::get()->query(sprintf("INSERT INTO vars (`user`,`name`,`value`) VALUES('%s','%s','%s')",
	mysqli_real_escape_string(DBC::get(),$_GET['user']),
	mysqli_real_escape_string(DBC::get(),$_GET['name']),
	mysqli_real_escape_string(DBC::get(),$_GET['value'])
	));
	if(!$result){
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
}
}
if(!$result){
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
}
echo 0;
flog("varwrite.php stopped");
exit;
?>
