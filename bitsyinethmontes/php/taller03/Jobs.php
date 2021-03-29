<?php
namespace php\taller03\Product;
error_reporting(E_ALL);
/**
* - Cree arreglo con al menos tres libros
* - la informacion se debe cargar automaticamente desde un archivo json, uno de los libros no debe tener informacion de capitulos
* - mediante el parametro contruct en la url debo elegir si inicializar lso valores de cada libro mediante el contructor o mediante setters
* - imprimir todas las propiedades de cada libro mediante getters o metodos magicos dependiendo de si el indice del libro en el arreglo es par o impar
* - Imprimir cantidad de capitulos de cada libro
* - hacer ciclo para obtener de manera aleatoria el nombre de tres capitulos de cada libro
* - Obtener paginas por capitulo para cada libro
* - Imprimir json cada libro
* - Destruir los libros
 */
require_once ("Book.php");

class Jobs extends Book
{
  protected $book = [];
  public function __construct()
  {
    
  }
    
  public function getInfoFile()
  {
    $infoToSend =  [];
    $getInfoFile = file_get_contents('books.json');
    $infoToSend = json_decode($getInfoFile);
    return $infoToSend;
  }

  /**
   * Contruct -> 0 -> por getter , 1 -> por constructor
   */
  public function sendInfoConstruct($contruct = null)
  {
    $infoFile = $this->getInfoFile();
    
    for ($i=0; $i < count($infoFile) ; $i++) 
    { 
      $this->book[$i] = new Book();
    }

    foreach ($infoFile as $key => $value) 
    {
      if($contruct==0)
      {
        $this->book[$key]->setName($value->name);
        $this->book[$key]->setPrice($value->price);
        $this->book[$key]->setAuthor($value->author);
        $this->book[$key]->setYear($value->year);
        $this->book[$key]->setSheets($value->sheets);
        
        if(isset($value->index))
        {
          $this->book[$key]->setIndex($value->index);
        }
      }
      else
      {
        $this->book[$key] = new Book($value->name , $value->price,$value->author,$value->year);
        $this->book[$key]->setSheets($value->sheets);
        if(isset($value->index))
        {
          $this->book[$key]->setIndex($value->index);
        }
      }

    }
  }

  public function propertyProduct()
  {
    $products = $this->book;
    foreach ($products as $key => $value) 
    {
      if($key % 2 == 0)
      {
        echo $this->book[$key]->description();
      }
      else
      {
        echo "El libro <b>".$this->book[$key]->getName()."</b> fue escrito por ".$this->book[$key]->getAuthor()." en el año ".$this->book[$key]->getYear();
        echo "<br> <i>Información Adicional </i>";
        echo "<ul>";
          echo "<li><b>Número de Páginas </b> ".$this->book[$key]->getChapters()."</li>";
          echo "<li><b>Promedio Páginas por Capítulo </b> ".$this->book[$key]->averageSheetsPerChapter()."</li>";
          $lib = $this->book[$key]->getIndex();
          if(count($lib) > 0)
          {
            echo "<li>";
              echo "<b> Índice Capítulos</b>";
              echo "<ul>";
                foreach ($lib as $key =>$value) 
                {
                  foreach ($value as $llave => $valor) 
                  {
                    echo "<li> Capitulo N° ".$llave." * ".$valor." * </li>";
                    # code...
                  }
                }
              echo "</ul>";
            echo "</li>";
          }
          else
          {
            echo "<li> No describe Capítulos</li>";
          }
          
        echo "</ul>";
      }
    }
  }

  public function chaptersCountBook()
  {
    $products = $this->book;
    foreach ($products as $key => $value) 
    {
      echo "Número de capítulos para el libro <b>".$this->book[$key]->getName()." </b> = ";
      if($this->book[$key]->getChapters() > 0)
      {
        echo $this->book[$key]->getChapters();
      }
      else
      {
        echo 0;
      }
      echo "<br>";
    }
  }

  public function nameRandom()
  {
    $products = $this->book;
    foreach ($products as $key => $value) 
    {
      echo "Libro : ".$this->book[$key]->getName()."<br>";
      if($this->book[$key]->getChapters() > 0)
      {
        echo "Algunos capítulos";
        echo "<ul>";
        for ($i=0; $i < 3 ; $i++) 
        { 
          $random = rand(0,$this->book[$key]->getChapters()-1);
          echo "<li>".$this->book[$key]->getChapterName($random)."</li>";
        }
        echo "</ul>";

      }
      else
      {
        echo "Este libro no tiene descripción de capítulos";
      }
    }
  }

  public function pagesBook()
  {
    $products = $this->book;
    foreach ($products as $key => $value) 
    {
      echo "<br>Las páginas promedio por capítulo para el libro <b>".$this->book[$key]->getName()." </b> son =  ";
      echo number_format($this->book[$key]->averageSheetsPerChapter(),0);
    }
  }
  
  public function jsonBook()
  {
    $products = $this->book;
    foreach ($products as $key => $value) 
    {
      echo json_encode(($this->book[$key]));
      echo "<br>";
    }
  }
  public function destroyBook()
  {
    $products = $this->book;
    foreach ($products as $key => $value) 
    {
      unset($book[$key]);
    }
  }

}

$jobs = new Jobs();
$jobs->sendInfoConstruct(0);
$jobs->propertyProduct();
$jobs->chaptersCountBook();
$jobs->nameRandom();
$jobs->pagesBook();
echo "<br>";
$jobs->jsonBook();
$jobs->destroyBook();

?>
