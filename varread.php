<?php
/*-------------------------------------
  Name:   varread.php
  Type:   PSF
  Params: name, user
  Auth:   admin
  Desc:   read var
-------------------------------------*/
require_once "log.php";
flog("varread.php started");
if(!isset($_GET['name'],$_GET['user'])) {
	echo -1;
	flog("ERR: -1");
	exit;
}
require "admin.php";
require_once "mysql.php";
$result = DBC::query(sprintf(
    "SELECT * FROM `vars` WHERE `user`='%s' AND `name`='%s'",
    mysqli_real_escape_string(DBC::get(),$_GET['user']),
    mysqli_real_escape_string(DBC::get(),$_GET['name'])
));
if(($result->num_rows)<1) {
	echo -5;
	flog("ERR: -5");
	exit;
}
echo 0;
echo $result->fetch_assoc()['value'];
flog("varread.php stopped");
?>
