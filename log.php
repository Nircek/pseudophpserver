<?php
/*-------------------------------------
  Name:   log.php
  Type:   PPSF / PSF
  Params: -- / log
  Auth:   -- / admin
  Desc:   save info in log
-------------------------------------*/
function flog($log) {
	$endl="\r\n";
	if(!$fp = fopen('log.txt','a')) {
		echo -4;
		exit;
	}
	if(!fputs($fp,date("[d-m-Y H:i:s]: ").$log.$endl)) {
		echo -4;
		exit;
	}
	fclose($fp);
}
//src: https://stackoverflow.com/a/12999758
if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
	flog('log.php started');
	if(!isset($_GET['log'])) {
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
