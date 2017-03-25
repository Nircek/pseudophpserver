<?php
//# log.php #
/*
PPSF/PSF

zapisuje info w logu

*/
function flog($log){
	$endl="
";
	if(!$fp = fopen('log.txt','a')){
		echo -4;
		exit;
	}
	if(!fputs($fp,date("[d-m-Y H:i:s]: ").$log.$endl)){
		echo -4;
		exit;
	}
	fclose($fp);
}
if((!isset($flog))||($flog!==true)){
	flog('log.php started');
	if(!isset($_GET['log'])){
		echo -1;
		flog("ERR: -1");
		exit;
	}
	require_once "admin.php";
	flog($_GET['log']);
	flog('log.php stopped');
	echo 0;
	exit;
}
?>
