<?php
//# mysql.php #
/*
PPSF

settings for database connection

*/

class DBC {
  //src: https://stackoverflow.com/a/16913680
  private static $instance;
  public static function get() {
    $cond = !self::$instance;
    if(!$cond)$cond = !(@self::$instance->ping());
    if($cond) {
      $db_host="localhost";
      $db_user="root";
      $db_pass="";
      $db_table="pps";
      self::$instance = @new mysqli($db_host,$db_user,$db_pass,$db_table);
      if(self::$instance->connect_errno!=0) {
	      echo "+";
	      echo self::$instance->connect_errno."\x12".self::$instance->connect_error;
	      flog("ERR: ".self::$instance->connect_error.'('.self::$instance->connect_errno.')');
	      exit;
      }
      self::$instance->set_charset("utf8");
    }
    return self::$instance;
  }
  function __destruct() {
    self::$instance->close();
  }
}

?>
