<?php
//# admin.php # (server=pass)
/*
PPSF

check if caller is the server

*/
$flog=true;
require_once "log.php";

if(!(isset($_GET['server'])&&($_GET['server']==="super secret password"))){
	echo -3;
	flog("ERR: Admin denied");
	exit;
}
flog("Admin granted");
?>
