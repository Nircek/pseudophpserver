<?php
/*-------------------------------------
  Name:   register.php
  Type:   PCF
  Params: user, pass
  Auth:   --
  Desc:   register new user
-------------------------------------*/
require_once "log.php";
flog("register.php started");
if(!isset($_GET['user'],$_GET['pass'])) {
	echo -1;
	flog("ERR: -1");
	exit;
}
require_once "mysql.php";
$result = DBC::query(sprintf(
    "SELECT * FROM users WHERE `user`='%s'",
    mysqli_real_escape_string(DBC::get(),$_GET['user'])
));
if($result->num_rows>0) {
	echo -6;
	flog("ERR: -6");
	exit;
} else {
	$result = DBC::query(sprintf(
	    "INSERT INTO users (`user`,`pass`) VALUES('%s','%s')",
	    mysqli_real_escape_string(DBC::get(),$_GET['user']),
	    mysqli_real_escape_string(DBC::get(),$_GET['pass'])
	));
}
echo 0;
flog("register.php stopped");
exit;
?>
