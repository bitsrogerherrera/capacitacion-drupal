<?php

//cnn.class.php se encarga de crear la instancia unica del objeto

require_once "parametros.php";
class Conexion
{

    private static $_instancia;
    private $_db;

    public static function getInstance()
    {
        if (!self::$_instancia) {
            self::$_instancia = new self();
            /* otra opcion
                        $c = __CLASS__;
             self::$instancia = new $c;
        */
        }
        return self::$_instancia;
    }


    private function __construct()
    {
        try {
            $this->db = new PDO(DB_MOTOR . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->db->setAttribute(PDO::ATTR_PERSISTENT, true);
            $this->db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede conectar a la base de datos' . E_USER_ERROR . PHP_EOL;
            echo "";
            echo "Detalle: " . $e->getMessage();
            exit;
        }
    }

    public function getConnection()
    {
        return $this->db;
    }

    public function CloseConnection()
    {
        return $this->db = null;
    }

    public function __clone()
    {
        trigger_error('No esta permitido clonar esta clase', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error("No puede deserializar una instancia de " . get_class($this) . " class.", E_USER_ERROR);
    }
}
