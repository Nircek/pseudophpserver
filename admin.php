<?php
//# admin.php #
/*
PPSF

sprawdza czy wywoływacz jest serwerem

*/

if(!(isset($_GET['server'])&&($_GET['server']==="super tajne hasło"))){
	echo -3;
	exit;
}
?>
