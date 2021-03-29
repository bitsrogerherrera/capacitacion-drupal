<?php

namespace Capacitacion\DB;

use PDO;

class ConnectDb {

  private static $instance = null;
  private $conn;
  
  private $host = '127.0.0.1';
  private $user = 'root';
  private $pass = '##';
  private $name = 'taller04';
   
  private function __construct()
  {
    $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->name}", $this->user,$this->pass,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
  }
  
  public static function getInstance() //se implementa el patron singleton
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectDb();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->conn;
  }
}


