<?php

/* Definir namespace */
namespace Taller03\Product;

require_once 'product.php';

class Book extends Product {

  /* Propiedades */
  protected $author;
  protected $index;
  protected $year;
  protected $sheets;

  /* Definir constructor */
  public function __construct($author = '', $year= '') {
    $this->author = $author;
    $this->year = $year;
  }

  /* Definir destructor */
  public function __destruct() {
    //parent::__destruct();
  }

  /* Métodos */
  public function getAuthor() {
    return $this->author;
  }

  public function setAuthor($author) {
    $this->author = $author;
  }

  public function getIndex() {
    return $this->index;
  }

  public function setIndex($index) {
    $this->index = $index;
  }

  public function getYear() {
    return $this->year;
  }

  public function setYear($year) {
    $this->year = $year;
  }

  public function getSheets() {
    return $this->sheets;
  }

  public function setSheets($sheets) {
    $this->sheets = $sheets;
  }

  public function description() {
    $description = parent::description();
    $description .= 'Autor: <span style="font-style: italic">' . $this->author . ", " . $this->year . '</span>';

    echo $description;
  }

  public function addChapter($chapterName, $chapterSheets) {
    $this->index[] = ['chapterName' => $chapterName, 'chapterSheets' => $chapterSheets];
  }

  public function getChapters() {
    $totalChapters = count($this->index);

    return $totalChapters;
    //echo 'El total de capítulos del libro es: ' . $totalChapters;
  }

  public function getChapterName($numberChapter) {
    $returnName = 'No existe capítulo.';

    foreach($this->index as $clave => $valor) {
      if ($clave == $numberChapter) {
        $returnName = 'El capítulo seleccionado es: ' . $this->index[$clave]['chapterName'];
      }
    }

    echo $returnName;
  }

  public function averageSheetsPerChapter() {
    try {
      $totalSheets = 0;
      $totalChapters = count($this->index);

      if ($totalChapters == 0) {
        throw new Exception('División por cero.');
      }

      foreach($this->index as $clave => $valor) {
        $totalSheets += $valor['chapterSheets'];
      }

      $average = $totalSheets / $totalChapters;
    } catch (\Throwable $e) {
      $average = 0;
		}

    //echo 'El promedio de hojas del libro es de: ' . round($average);
    return round($average);
  }
}
?>