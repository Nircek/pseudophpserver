<?php
//# admin.php #
/*
PPSF

sprawdza czy wywoływacz jest serwerem

*/
$flog=true;
require_once "log.php";

if(!(isset($_GET['server'])&&($_GET['server']==="super tajne hasło"))){
	echo -3;
	flog("ERR: Admin denied");
	exit;
}
flog("Admin granted");
?>
