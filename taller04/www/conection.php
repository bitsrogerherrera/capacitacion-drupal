<?php

namespace connectDB;

use PDO;
use PDOException;

class ConnectDb
{

    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'Bits2021<>';
    private $name = 'books';
    // The db connection is established in the private constructor.
    private function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host}; dbname={$this->name}", $this->user, $this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
            // echo "Connected successfully \n";
        } catch (PDOException $e) {
            //throw $th;
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnectDb();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getBooks()
    {
        try {
            $listBook = [];
            $result = $this->conn->prepare("SELECT * FROM book");
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result->fetchAll() as $row) {
                array_push($listBook, $row);
            }
            return $listBook;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getBooksJoinChapters()
    {
        try {
            $listBookChapters = [];
            $result = $this->conn->prepare("SELECT * FROM `book` as b RIGHT JOIN chapters as c ON b.id = c.idbook");
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result->fetchAll() as $row) {
                array_push($listBookChapters, $row);
            }
            return $listBookChapters;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function setBook($datos)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO book (title, author, yearb) VALUES (:title, :author, :yearb)");

            if ($stmt->execute(array(':title' => $datos[0], ':author' => $datos[1], ':yearb' => $datos[2]))) {
                echo "Se ha creado el nuevo registro!";
                header("Location: chapters.php");
                die();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function setBookIterative($datos)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO book (title, author, yearb) VALUES (:title, :author, :yearb)");

            if ($stmt->execute(array(':title' => $datos[0], ':author' => $datos[1], ':yearb' => $datos[2]))) {
                echo "Se ha creado el nuevo registro!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function setChapters($datos)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO chapters (titlechapter, numchapter, idbook)
            VALUES (:titlechapter, :numchapter, :idbook)");

            if ($stmt->execute(array(':titlechapter' => $datos[0], ':numchapter' => $datos[1], ':idbook' => $datos[2]))) {
                echo "Se ha creado el nuevo registro!";
            } else {
                echo"algo salio mal";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function searchBook($title)
    {
        try {
            $result = $this->conn->prepare("SELECT id FROM book WHERE title LIKE '%$title%'");
            $result->execute();
            $index = $result->fetch();
            return $index['id'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
