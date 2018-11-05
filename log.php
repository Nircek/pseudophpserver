<?php
/*
MIT License

Copyright (c) 2017-2018 Nircek

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/
/*-------------------------------------
  Name:   log.php
  Type:   PPSF / PSF
  Params: -- / log
  Auth:   -- / admin
  Desc:   save info in log
-------------------------------------*/
function flog($log) {
	$endl="\r\n";
	$fp = fopen('log.txt','a') or got(-4,'','',false);
	fputs($fp,date("[d-m-Y H:i:s]: ").$log.$endl) or got(-4,'','',false);
	fclose($fp);
}
flog(basename($_SERVER["SCRIPT_FILENAME"]).' started');
function got($type='?', $code='', $desc='', $log=true) {
    if($type<0) {
        $f = $type;
    } else {
        $f = $type;
        $f .= $code;
        if($desc)
            $f .= "\xB2".$desc;
    }
    echo $f."\r\n";
    if(!$log)
        exit;
    if($type=='0')
        $f = 'OK['.basename($_SERVER["SCRIPT_FILENAME"]).']';
    else {
    $f = 'ERR['.basename($_SERVER["SCRIPT_FILENAME"]).']: ';
    if($desc)
        $f .= $desc.' ('.$code.').';
    else if($type<0 && $code)
        $f .= $code.' ('.$type.').';
    else
        $f .= $type.$code;
    }
    flog($f);
    exit;
}
//src: https://stackoverflow.com/a/12999758
if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
	if(!isset($_GET['log']))
	    got(-1);
	require_once "admin.php";
	flog($_GET['log']);
	got(0);
}
?>
