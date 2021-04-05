<?php

namespace Php\Connection;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'Diiego150**';
    private $name = 'taller04';

    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};
        dbname={$this->name}", $this->user,$this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            echo "Connection success" . "<br>";
        } catch (PDOException $e) {
            echo "Error en la conexion: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}