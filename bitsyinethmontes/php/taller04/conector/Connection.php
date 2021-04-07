<?php
require_once("ConfigDataBd.php");
class Connection
{
  private static $instance;
  private $dbConn;

  private function __construct(){}
  
  public static function getInstance()
  {
    if (!isset(self::$instance)) 
    {
      // Instanciación de la clase, llama a __construct()
      self::$instance = new self();
    }
    return self::$instance;
  }

  public static function startConnection()
  {
    $db = self::getInstance();
    $confDataBd = ConfigDataBd();
    $db->dbConn = new mysqli($confDataBd['host'], $confDataBd['user'], $confDataBd['password'],$confDataBd['bd']);
    $db->dbConn->set_charset('utf8');

    return $db;
  }

  public static function getConnection()
  {
    try 
    {
      $db = self::startConnection();
      return $db->dbConn;
    } 
    catch (Exception $ex) 
    {
      echo "No fue posible conectar con la base de datos ".$ex->getMessage();
      return null;
    }
  }
}

/*$connect = Connection::getConnection();
var_dump($connect);*/
?>