<?php

namespace taller04\Book;

use Exception;
use taller04\Product\Product;

require('Product.php');


class Book extends Product
{

  protected $author, $index = [], $year, $sheets;

  public function __construct($name= null, $price=null, $author = null, $year = null)
  {
    $number_of_arguments = func_num_args();
    if($number_of_arguments===1){
      $this->name = $name;
    }elseif($number_of_arguments<=2){
      $this->name = $name;
      $this->price = $price;
    }elseif($number_of_arguments<=3){
      $this->name = $name;
      $this->price = $price;
      $this->author = $author;
    } elseif($number_of_arguments<=4){
      $this->name = $name;
      $this->price = $price;
      $this->author = $author;
      $this->year = $year;
    }
  }

  public function __destruct()
  {
    // print "\n Producto $this->name eliminado";
  }
  public function getAuthor()
  {
    return $this->author;
  }
  public function setAuthor($author)
  {
    $this->author = $author;
  }
  public function getIndex()
  {
    return $this->index;
  }
  public function setIndex($index)
  {
    $this->index = $index;
  }
  public function getYear()
  {
    return $this->year;
  }
  public function setYear($year)
  {
    $this->year = $year;
  }
  public function getSheets()
  {
    return $this->sheets;
  }
  public function setsheets($sheets)
  {
    $this->sheets = $sheets;
  }
  public function addChapter($chapter, $sheets)
  {
    $this->index[] = $chapter;
    $this->sheets += $sheets;
  }
  public function getChapters()
  {
    return count($this->index);
  }
  public function getChapterName($num)
  {
    return isset($this->index[$num]) ? $this->index[$num] : 'Indefinido';
  }
  public function description()
  {
    $countChapter = $this->getChapters();
    return "Nombre: $this->name, precio:  $this->price \n capitulos: $countChapter, hojas: $this->sheets";
  }
  public function averageSheetsPerChapter()
  {
    try {
      $countChapter = $this->getChapters();
      if ($countChapter <= 0)
        throw new Exception("Division por cero", 1);
      return $this->sheets / $countChapter;
    } catch (\Throwable $th) {
      return  0;
    }
  }
}
