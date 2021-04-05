<?php

namespace Php\SaveData;

use Exception;
use Php\Connection\Connection;

require_once '../taller03/db/Connection.php';


class DataSave
{
    public function insertDb()
    {
        try {
            $instance = Connection::getInstance();
            $conn = $instance->getConnection();

            $data = file_get_contents("../taller03/json/Libros.json");
            $books = json_decode($data, true);

            for($i =0; $i<count($books); $i++) {

                $ib = $books[$i]['id_book'];
                $nb = $books[$i]['nameBook'];
                $nc = json_encode($books[$i]['numChapter']['ind_libro']);
                $nameC = json_encode($books[$i]['nameChapter']['namCap']);

                $sentencia = $conn->query("INSERT INTO books (id_book, nameBook, numChapter, nameChapter)
                VALUES ('$ib', '$nb', '$nc', '$nameC')");
            }
            echo "INSERT SUCCESS" . "<br>";
        } catch (Exception $e) {
            echo "Error insert: " . $e ->getMessage();
        }
    }

    public function allBooks()
    {
        try {

            $instance = Connection::getInstance();
            $conn = $instance->getConnection();

            $query = "SELECT * FROM books";
            $result = $conn->query($query);

            foreach ($result as $row) {
                echo $row['id_book'] . " Nombre libro: " . $row['nameBook'] .
                    " | Numero de capitulos: " .$row['numChapter'] .
                    " | Nombre capitulos: " .$row['nameChapter'];
                print "<br><br>";
            }
            echo "CONSULTA SUCCESS";
        } catch (Exception $e) {
            echo "Error consulta";
        }
    }
}

$books = new DataSave();
$books ->insertDb();
$books ->allBooks();
