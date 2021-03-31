<?php

namespace taller04\Library;

require("Book.php");
require_once("ConnectDb.php");

use PDO;
use Exception;
use PDOException;
use taller04\Book\Book;
use taller04\ConnectDb\ConnectDb;

class Library extends Book
{
  protected $books = [], $initSetters = false;
  public function __construct()
  {
    if (isset($_GET['construt'])  && $_GET['construt']  === 'setters') {
      $this->initSetters = true;
    }
    $this->createArrayBooks();
  }

  public function createArrayBooks()
  {
    $arrayBooks = $this->getData();
    foreach ($arrayBooks as $key => $value) {

      if ($this->initSetters) {
        $tmp = $this->newInstanceSetters($value);
      } else {
        $tmp = $this->newInstanceConstruct($value);
      }
      foreach ($value->chapters as $key => $chapter) {
        $tmp->addChapter($chapter->title, $chapter->pages);
      }

      $this->books[] = $tmp;
    }
  }
  protected function newInstanceSetters($value)
  {
    $tmp = new Book;
    $tmp->setName($value->name);
    $tmp->setPrice($value->price);
    $tmp->setAuthor($value->author);
    return $tmp;
  }
  protected function newInstanceConstruct($value)
  {
    return new Book($value->name, $value->price, $value->author, $value->year);
  }
  protected function getData()
  {
    $string = file_get_contents("./json/books.json");
    $decode = json_decode($string);
    $arrayBooks = $decode->books;
    return $arrayBooks;
  }
  public function printBooks()
  {
    foreach ($this->books as $key => $book) {
      if ($key % 2 == 0) {
        $descripction = $book->description();
      } else {
        $descripction = $book->description();
      }
      print "\nLa descripción($key) es: $descripction";
    }
  }
  public function printChapterBooks()
  {
    foreach ($this->books as $key => $book) {
      $count = $book->getChapters();
      print "\nLa cantidad de capitulos de($book->name) es: $count";
    }
  }
  public function randonChapterBooks()
  {
    foreach ($this->books as $key => $book) {
      print "\n Capitulos aleatorios de $book->name:";
      for ($i = 0; $i < 3; $i++) {
        $count = $book->getChapters();
        try {
          if ($count <= 1)
            throw new Exception("Error Processing Request", 1);
          $randonIndex = random_int(0, $count - 1);
          $name = $book->getChapterName($randonIndex);
          print "\n  -$name";
        } catch (\Throwable $th) {
          continue;
        }
      }
    }
  }
  public function printJson()
  {
    foreach ($this->books as $key => $book) {
      $json = json_encode(get_object_vars($book));
      print($json);
    }
  }
  public function saveDbBooks()
  {
    $instance = ConnectDb::getInstance();
    $conn = $instance->getConnection();
    foreach ($this->books as $key => $book) {
      $chapters = "";
      foreach ($book->index as $key => $chapter) {
        $chapters .= "$chapter ";
      }
      $data = [
        "id" => null,
        "name" => isset($book->name) && $book->name !== "" ? $book->name : null,
        "author" => isset($book->author) && $book->author !== "" ? $book->author : null,
        "price" => isset($book->price) && $book->price !== "" ? $book->price : null,
        "year" => isset($book->year) && $book->year !== "" ? $book->year : null,
        "chapters" => isset($chapters) && $chapters !== "" ? $chapters : null
      ];
      $sql = "INSERT INTO books (id, name, author, price, year, chapters) VALUES( :id, :name, :author, :price, :year, :chapters)";

      $stmt = $conn->prepare($sql);
      $res = $stmt->execute($data);
    }
  }
  public function saveOneBook()
  {
    try {
      $instance = ConnectDb::getInstance();
      $conn = $instance->getConnection();
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      return ["", "", ""];
      die();
    }
    $errorName = "";
    $save = "";
    $errorSave = "";
    if (isset($_POST["crear"])) {
      if ($_POST["name"] !== '') {
        $data = [
          "id" => NULL,
          "name" => $_POST["name"],
          "author" => isset($_POST["author"]) && $_POST["author"] !== "" ? $_POST["author"] : null,
          "price" => isset($_POST["price"]) && $_POST["price"] !== "" ? $_POST["price"] : null,
          "year" => isset($_POST["year"]) && $_POST["year"] !== "" ? $_POST["year"] : null,
          "chapters" => isset($_POST["chapters"]) && $_POST["chapters"] !== "" ? $_POST["chapters"] : null
        ];
        $sql = "INSERT INTO books (id, name, author, price, year, chapters) VALUES( :id, :name, :author, :price, :year, :chapters)";

        $stmt = $conn->prepare($sql);
        $res = $stmt->execute($data);
        if (!$res) {
          $errorSave = "Error al guardar";
        } else {
          $save = "Guardó un nuevo libro";
        }
      } else {
        $errorName = "El campo nombre es obligatorio";
      }
    }
    return [
      $errorName, $save, $errorSave
    ];
  }
  public function getAllBooksDb()
  {
    try {
      if (isset($_POST["cargar"])) {
        $this->saveDbBooks();
      }
      $instance = ConnectDb::getInstance();
      $conn = $instance->getConnection();
      $stmt = $conn->prepare("SELECT * FROM books");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $books = $stmt->fetchAll();
      return $books;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      return [];
      die();
    }
  }
}
