<?php
/*-------------------------------------
  Name:   reply.php
  Type:   PSF
  Params: text, user
  Auth:   admin
  Desc:   reply to client
-------------------------------------*/
require_once "log.php";
flog("reply.php started");
if(!isset($_GET['text'],$_GET['user'])) {
	echo -1;
	flog("ERR: -1");
	exit;
}
require "admin.php";
require_once "mysql.php";
$result = DBC::query(sprintf(
    "SELECT * FROM pcqueue WHERE `user`='%s'",
    mysqli_real_escape_string(DBC::get(),$_GET['user'])
));
if($result->num_rows>0) {
	$result = DBC::query(sprintf(
	    "UPDATE pcqueue SET `text`='%s' WHERE `user`='%s'",
		mysqli_real_escape_string(DBC::get(),$_GET['text']),
		mysqli_real_escape_string(DBC::get(),$_GET['user'])
	));
} else {
	$result = DBC::query(sprintf(
	    "INSERT INTO pcqueue (`user`,`text`) VALUES('%s','%s')",
	    mysqli_real_escape_string(DBC::get(),$_GET['user']),
	    mysqli_real_escape_string(DBC::get(),$_GET['text'])
	));
}
echo 0;
flog("reply.php stopped");
exit;


?>
