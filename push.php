<?php
/*-------------------------------------
  Name:   push.php
  Type:   PCF
  Params: event
  Auth:   login
  Desc:   push event to event queue
-------------------------------------*/
require_once "log.php";
flog("push.php started");
if(!isset($_GET['event'])) {
	echo -1;
	flog("ERR: -1");
	exit;
}
require_once "mysql.php";
require_once "login.php";
$result = DBC::query(sprintf(
    "INSERT INTO `psqueue`(`id`,`user`,`name`) VALUES ('','%s','%s')",
    mysqli_real_escape_string(DBC::get(),$_GET['user']),
    mysqli_real_escape_string(DBC::get(),$_GET['event'])
));
echo 0;
flog("push.php stopped");
exit;
?>
