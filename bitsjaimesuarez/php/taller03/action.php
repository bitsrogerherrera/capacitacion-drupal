<?php

/* Definir namespace */
namespace Taller03\Product;

require_once 'book.php';

class ActionReadExecute extends Book {
  protected $books;

  public function __construct() {  }

  public function loadInfoJson() {
    $booksJson = [];
    $data = file_get_contents('books.json');
    $booksJson = json_decode($data);

    $this->loadInfoConstruct($booksJson);
  }

  public function loadInfoConstruct($booksJson) {
    $this->books = [];
    $flagIndex = false;

    foreach($booksJson as $clave => $valor) {
      $this->books[$clave] = [
        "nameBook" => $this->setName($valor->nameBook),
        "priceBook" => $this->setPrice($valor->priceBook),
        "authorBook" => $this->setAuthor($valor->authorBook),
        "yearBook" => $this->setYear($valor->yearBook)
      ];

      $this->index = [];
      if (isset($valor->informationBook)) {
        $flagIndex = true;

        for ($i = 0; $i < count($valor->informationBook); $i++) {
          if ($flagIndex) {
            $this->books[$clave] = [
              "informationBook" => $this->addChapter($valor->informationBook[$i]->chapterName, $valor->informationBook[$i]->chapterSheets)
            ];
          }
        }
      } else {
        $flagIndex = false;
      }

      $chapters = ($this->books[$clave]["informationBook"] = $this->getIndex());

      if ($clave % 2 == 0) {
        echo '
          <p>
            El libro <span style="font-weight: bold">'. $this->books[$clave]["nameBook"] = $this->getName() .'</span> ('. $this->books[$clave]["yearBook"] = $this->getYear() .') del escritor:
            <span style="font-style: italic">'. $this->books[$clave]["authorBook"] = $this->getAuthor() .'</span>,
            <br /> cuenta con las siguientes características:
            <ul>
              <li>Precio: <span style="font-weight: bold">'. $this->books[$clave]["priceBook"] = $this->getPrice() .'</span></li>
              <li>Total de capítulos: '. $this->getChapters() .'</li>
              <li>Promedio de hojas por capítulos: '. $this->averageSheetsPerChapter() .'</li>
              <li>Capítulos del libro: </li>';
              for ($k = 0; $k < count($chapters); $k++) {
                echo '<ul><li>'. $chapters[$k]['chapterName'] .' (Páginas: '.$chapters[$k]['chapterSheets'].' )</li></ul>';
              }
            echo '</ul>
          </p>';
      }

      // Imprimir cantidad de cápitulos de cada libro
      echo '
        <div>
          <ul>
            <li>Libro: '.$this->books[$clave]["nameBook"] = $this->getName().'</li>
            <ul><li>Cantidad de Cápitulos: '. $this->getChapters() .'</li></ul>
          </ul>
        </div>';

      //Rand para capítulos
      if (isset($valor->informationBook)) {
        $randChapter = array_rand($chapters, 3);
        echo '
          <h4>Capítulos Rand</h4>
          <ul>
            <li>'. $chapters[$randChapter[0]]['chapterName'] .'</li>
            <li>'. $chapters[$randChapter[1]]['chapterName'] .'</li>
            <li>'. $chapters[$randChapter[2]]['chapterName'] .'</li>
          </ul>';
      }
    }
  }
}
?>