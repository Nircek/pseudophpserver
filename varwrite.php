<?php
/*-------------------------------------
  Name:   varwrite.php
  Type:   PSF
  Params: name, user, value
  Auth:   admin
  Desc:   set var
-------------------------------------*/
require_once "log.php";
flog("varwrite.php started");
if(!isset($_GET['name'],$_GET['user'],$_GET['value'])) {
	echo -1;
	flog("ERR: -1");
	exit;
}
require "admin.php";
require_once "mysql.php";
$result = DBC::query(sprintf(
    "SELECT * FROM vars WHERE `user`='%s' AND `name`='%s'",
    mysqli_real_escape_string(DBC::get(),$_GET['user']),
    mysqli_real_escape_string(DBC::get(),$_GET['name'])
));
if($result->num_rows>0) {
	$result = DBC::query(sprintf("UPDATE vars SET `value`='%s' WHERE `user`='%s' AND `name`='%s'",
		mysqli_real_escape_string(DBC::get(),$_GET['value']),
		mysqli_real_escape_string(DBC::get(),$_GET['user']),
		mysqli_real_escape_string(DBC::get(),$_GET['name'])
	));
} else {
	$result = DBC::query(sprintf(
	    "INSERT INTO vars (`user`,`name`,`value`) VALUES('%s','%s','%s')",
	    mysqli_real_escape_string(DBC::get(),$_GET['user']),
	    mysqli_real_escape_string(DBC::get(),$_GET['name']),
	    mysqli_real_escape_string(DBC::get(),$_GET['value'])
	));
}
echo 0;
flog("varwrite.php stopped");
exit;
?>
