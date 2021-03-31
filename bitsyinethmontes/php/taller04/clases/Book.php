<?php
namespace php\taller03\Product;
error_reporting(E_ALL);
use Exception;
/**
* - Definir namespace
* - Crear contructor con y sin parametros (no incluir parametros index y sheets)
* - Crear destructor que imprima un mensaje indicando que se elimino el producto
* - Crear las propiedades protegidas author, index, year y sheets con getters y seetterrs
* - La propiedad index debe ser una arreglo con el listado de capitulos del libro, debe tener numero y nombre del capitulo
* - sobreescribir el metodo description para obtener una descripcion para que incluya los nuevos atributos 
* - Crear un metodo addChapter que permita agregar capitulos al libro, debe recibir nombre del capitulo y hojas del capitulo, el metodo debe ubicar el nuevo capitulo al final del listado, actualizar el listado de capitulos y agregar la cantidad de hojas al libro
* - Crear metodo getChapters que me obtenga la cantidad de capitulos
* - Crear metodo getChapterName que me obtenga el nombre  de un capitulo indicandole un numero
* - Crear metodo averageSheetsPerChapter que me obtenga el promedio de hojas por capitulo controlor mediante excepcion que retorne 0 cuando no se ha creado ningun capitulo
 */
require_once ("Product.php");
include_once ("../conector/Connection.php");

trait JsonSerializer 
{
  public function jsonSerialize()
  {
    return get_object_vars($this);
  }
}
class Book extends Product implements \JsonSerializable
{
  use JsonSerializer;
  protected $author;
  protected $index = [];
  protected $year;
  protected $sheets = [];
  
  public function __construct($name=null,$price= null,$author=null,$year=null) 
  {
    
    parent::__construct($name,$price);

    if(isset($author))
    {
      $this->author = $author;
    }
    if(isset($year))
    {
      $this->year = $year;
    }
  }

  public function setAuthor($author)
  {
    $this->author = $author;
  }

  public function getAuthor()
  {
    return $this->author;
  }

  public function setIndex($index)
  {
    if(!empty($index))
    {
      array_push($this->index,$index);
    }
  }

  public function getIndex()
  {
    return $this->index;
  }

  public function setYear($year)
  {
    $this->year = $year;
  }

  public function getYear()
  {
    return $this->year;
  }

  public function setSheets($sheets)
  {
    if(!empty($sheets))
    {
      array_push($this->sheets, $sheets);
    }
  }

  public function getSheets()
  {
    return $this->sheets;
  }

  public function description()
  {
    $detail = "Información Libro : <br>";
    $detail = "<ul>";
      $detail .= " <li> <b> Nombre : </b> ".$this->getName()." </li>";
      $detail .= " <li> <b> Autor : </b> ".$this->getAuthor()." </li>";
      $detail .= " <li> <b> Año   : </b> ".$this->getYear()." </li>";

      $lib = $this->getIndex();
      if(count($lib) >0)
      {
        $detail .= "<li>";
          $detail .= "<b> Índice Capítulos</b>";
          $detail .= "<ul>";
            foreach ($lib as $key =>$value) 
            {
              foreach ($value as $llave => $valor) 
              {
                $detail .= "<li> Capitulo N° ".$llave." * ".$valor." * </li>";
                # code...
              }
            }
          $detail .= "</ul>";
        $detail .= "</li>";
      }
      else
      {
        $detail .= "<li> No describe Capítulos</li>";
      }
    $detail .= "</ul>";
    return $detail;;
  }

  public function addChapter($nameChap,$sheetChap)
  {
    if(is_int($sheetChap))
    {
      $this->setIndex($nameChap);
      $this->setSheets($sheetChap);
      echo "<p style='color:green'>Agregado el capítulo ".$nameChap." </p>";
    }
    else
    {
      echo "<p style='color:red'>El número de páginas del capítulo <b>".$nameChap."</b> debe ser numérico </p>";
    }
  }

  public function getChapters()
  {
    $numChap = count($this->getIndex()[0]);
    return  $numChap;
  }

  public function getChapterName($numChap)
  {
    //var_dump($this->getIndex());
    $justKeyChap = array_keys($this->getIndex()[0]);
    if(in_array($numChap, $justKeyChap))
    {
      $chapterName = "El capítulo N°".$numChap." es : <i>".$this->getIndex()[0][$numChap]."</i>";
    }
    else
    {
      $chapterName = "No se encuentra el capítulo N° ".$numChap;
    }
    return $chapterName;
  }

  public function averageSheetsPerChapter()
  {
    $sumSheet = 0;
    try 
    {
      $sheets = $this->getSheets();
      foreach ($sheets as $sheet) 
      {
        if(is_numeric($sheet))
        {
          $sumSheet += $sheet;
        }
      }
      $numChap = $this->getChapters();
  
      if($numChap <= 0 || $sumSheet <=0)
      {
        throw new Exception(0);
      }
      
      $average = $sumSheet/$numChap;
    
      return $average;
    } 
    catch (\Exception $e) 
    {
      return $e->getMessage();
    }

  }

  public function __destruct() 
  {

  }

}

/*echo "***TEST*** <br>";

$producto = new Product('Librito Lindo' , '25.000');
echo "Obtener Nombre ->  ".$producto->getName();
echo "<br>";
echo "Obtener Precio  ->  ".$producto->getPrice();
echo "<br><br>";
echo "Obtener Descripción completa : <br> ";
echo $producto->description();

echo "<br>";
$book = new Book();
echo "Usando Libro <br>";
$book->setAuthor('EL Autor ');
$book->setYear('El Year ');
echo $book->addChapter('Cap ',"200");
echo $book->addChapter('Caps ',100);
echo $book->addChapter('Capsi ',150);
echo "<br>";
echo "LA DESCRIPCIÓN ".$book->description();
echo "Cantidad de Capítulos ->".$book->getChapters()."<br>";
echo "Nombre Cap 3  ->".$book->getChapterName(3)."<br>";
echo "Nombre Cap 0  ->".$book->getChapterName(0)."<br>";
echo "Promedio ->".$book->averageSheetsPerChapter()." <br> ";
echo "<br>";*/

?>