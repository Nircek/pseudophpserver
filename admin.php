<?php
/*-------------------------------------
  Name:   admin.php
  Type:   PPSF
  Params: server
  Auth:   --
  Desc:   check if caller is the server
-------------------------------------*/
require_once "log.php";
require 'data.php';
if(!(isset($_GET['server'])&&($_GET['server']===$token))) {
	echo -3;
	flog("ERR: Admin denied");
	exit;
}
flog("Admin granted");
?>
