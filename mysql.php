<?php
//# mysql.php #
/*
PPSF

settings for database connection

*/

require 'data.php';
class DBC {
  //src: https://stackoverflow.com/a/16913680
  private static $instance;
  public static function get() {
    $cond = !self::$instance;
    if(!$cond)$cond = !(@self::$instance->ping());
    if($cond) {
      global $db_host,$db_user,$db_pass,$db_table;
      self::$instance = @new mysqli($db_host,$db_user,$db_pass,$db_table);
      if(self::$instance->connect_errno!=0) {
	      echo "+";
	      echo self::$instance->connect_errno."\xB2".self::$instance->connect_error;
	      flog("ERR: ".self::$instance->connect_error.'('.self::$instance->connect_errno.')');
	      exit;
      }
      self::$instance->set_charset("utf8");
    }
    return self::$instance;
  }
  public static function query($s) {
    $result=self::get()->query($s);
    if(!$result){
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
