<?php
/*-------------------------------------
  Name:   login.php
  Type:   PPSF
  Params: user, pass
  Auth:   --
  Desc:   check if user's login data is correct
-------------------------------------*/
require_once "log.php";
if(!isset($_GET['user'],$_GET['pass'])) {
	echo -2;
	flog("ERR: User denied");
	exit;
}
require_once "mysql.php";
$result = DBC::query(sprintf(
    "SELECT * FROM `users` WHERE `user`='%s' AND `pass`='%s'",
    mysqli_real_escape_string(DBC::get(),$_GET['user']),
    mysqli_real_escape_string(DBC::get(),$_GET['pass'])
));
if($result->num_rows===0) {
	echo -2;
	flog("ERR: User denied");
	exit;
}
flog("User granted");
?>
