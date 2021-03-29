<?php

namespace Capacitacion\DB;

use PDO;

require_once "Connect.php";

class Requests{
  public function __construct(){}

  public function getAddBooks($books){
    
    $database_object = ConnectDb::getInstance();
    $connection = $database_object->getConnection();
    $data = [
      'name' => $books["name"],
      'price' => $books["price"],
      'author' => $books["author"],
      'year' => $books["year"],
      'chapters' => (isset($books["chapters"]) ? json_encode($books["chapters"]) : null)
    ];
    
    $query = "INSERT INTO book (name, price, author, year, chapters) VALUES (:name, :price, :author, :year, :chapters)";
    return $connection->prepare($query)->execute($data);
  }


  public function getAllBooks(){
    $database_object = ConnectDb::getInstance();
    $connection = $database_object->getConnection();

    $query = "SELECT * FROM `book`";
    $stmt = $connection->prepare($query);
    $stmt->execute([]);
    $books = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $books;
  }
}