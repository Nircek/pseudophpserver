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
  Name:   varwrite.php
  Type:   PSF
  Params: name, user, value
  Auth:   admin
  Desc:   set var
-------------------------------------*/
require_once "log.php";
if(!isset($_REQUEST['name'],$_REQUEST['user'],$_REQUEST['value']))
    got(-1);
require "admin.php";
require_once "mysql.php";
$result = DBC::query(sprintf(
    "SELECT * FROM vars WHERE `user`='%s' AND `name`='%s'",
    mysqli_real_escape_string(DBC::get(),$_REQUEST['user']),
    mysqli_real_escape_string(DBC::get(),$_REQUEST['name'])
));
if($result->num_rows>0)
	DBC::query(sprintf("UPDATE vars SET `value`='%s' WHERE `user`='%s' AND `name`='%s'",
		mysqli_real_escape_string(DBC::get(),$_REQUEST['value']),
		mysqli_real_escape_string(DBC::get(),$_REQUEST['user']),
		mysqli_real_escape_string(DBC::get(),$_REQUEST['name'])
	));
else
	DBC::query(sprintf(
	    "INSERT INTO vars (`user`,`name`,`value`) VALUES('%s','%s','%s')",
	    mysqli_real_escape_string(DBC::get(),$_REQUEST['user']),
	    mysqli_real_escape_string(DBC::get(),$_REQUEST['name']),
	    mysqli_real_escape_string(DBC::get(),$_REQUEST['value'])
	));
got(0);
?>
