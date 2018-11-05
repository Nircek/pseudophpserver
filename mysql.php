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
  Name:   mysql.php
  Type:   PPSF
  Params: --
  Auth:   --
  Desc:   functions for database connection
-------------------------------------*/
class DBC {
  //src: https://stackoverflow.com/a/16913680
  private static $instance;
  public static function get() {
    $cond = !self::$instance;
    if(!$cond)$cond = !(@self::$instance->ping());
    if($cond) {
      require 'data.php';
      self::$instance = @new mysqli($db_host,$db_user,$db_pass,$db_table);
      if(self::$instance->connect_errno!=0) {
	      echo "+";
	      echo self::$instance->connect_errno."\xB2".self::$instance->connect_error;
	      flog("ERR: ".self::$instance->connect_error.'('.self::$instance->connect_errno.')');
	      exit;
      }
      self::$instance->set_charset("utf8");
    }
    /*
    CREATE TABLE IF NOT EXISTS psqueue ( id MEDIUMINT NOT NULL AUTO_INCREMENT, name TEXT NOT NULL, user TEXT NOT NULL, PRIMARY KEY (id) );
    CREATE TABLE IF NOT EXISTS users ( user TEXT NOT NULL, pass TEXT NOT NULL );
    CREATE TABLE IF NOT EXISTS vars ( user TEXT NOT NULL, name TEXT NOT NULL, value TEXT NOT NULL );
    */
    return self::$instance;
  }
  public static function query($s) {
    $result=self::get()->query($s);
    if(!$result) {
	    echo "+";
	    echo DBC::get()->errno."\xB2".DBC::get()->error;
	    flog("ERR: ".DBC::get()->error.'('.DBC::get()->errno.')');
	    exit;
    }
  }
  function __destruct() {
    self::$instance->close();
  }
}

?>
