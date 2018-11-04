<?php
//# reply.php # (text=text, user=user) + admin
/*
PSF

reply to client

*/
$flog=true;
require_once "log.php";
flog("reply.php started");
if(!isset($_GET['text'],$_GET['user'])){
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

$result=DBC::get()->query(sprintf("SELECT * FROM pcqueue WHERE `user`='%s'",
mysqli_real_escape_string(DBC::get(),$_GET['user'])));
if(!$result){
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
}
if($result->num_rows>0){
	$result = DBC::get()->query(sprintf("UPDATE pcqueue SET `text`='%s' WHERE `user`='%s'",
		mysqli_real_escape_string(DBC::get(),$_GET['text']),
		mysqli_real_escape_string(DBC::get(),$_GET['user'])));
	if(!$result){
	echo "+";
	echo DBC::get()->errno."\xB2".DBC::get()->error;
	flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	exit;
	}
}else{
	$result = DBC::get()->query(sprintf("INSERT INTO pcqueue (`user`,`text`) VALUES('%s','%s')",
	mysqli_real_escape_string(DBC::get(),$_GET['user']),
	mysqli_real_escape_string(DBC::get(),$_GET['text'])
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
flog("reply.php stopped");
exit;


?>
