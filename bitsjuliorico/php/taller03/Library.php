<?php

namespace taller03\Library;

use Exception;
use taller03\Book\Book;

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
    return new Book($value->name);
    // return new Book($value->name, $value->price,$value->author);
  }
  protected function getData()
  {
    $string = file_get_contents("./books.json");
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
}
