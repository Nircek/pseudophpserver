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
  Name:   login.php
  Type:   PPSF
  Params: user, pass
  Auth:   --
  Desc:   check if user's login data is correct
-------------------------------------*/
require_once "log.php";
if(!isset($_GET['user'],$_GET['pass']))
    got('-', 2, 'User denied');
require_once "mysql.php";
$result = DBC::query(sprintf(
    "SELECT * FROM `users` WHERE `user`='%s' AND `pass`='%s'",
    mysqli_real_escape_string(DBC::get(),$_GET['user']),
    mysqli_real_escape_string(DBC::get(),$_GET['pass'])
));
if($result->num_rows==0)
	got('-', 2, 'User denied');
flog("User granted");
?>
