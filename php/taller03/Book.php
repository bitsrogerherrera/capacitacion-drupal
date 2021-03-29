<?php

namespace Capacitacion\Php;

require_once "Product.php";

class Book extends Product{

	protected $author;
	protected $index = [];
	protected $year;
	protected $sheets = []; 

	public function __construct($author = "", $year = ""){
		$this->author = $author;
		$this->year = $year;
	}

	public function __destruct() {
		echo '<br/><br/> Book Eliminado.</br></br>';
	}

	public function getAuthor(){
		return $this->author;
	}

	public function getIndex(){
		return $this->index;
	}

	public function getYear(){
		return $this->year;
	}

	public function getSheets(){
		echo "# de paginas del libro: " . array_sum($this->sheets);
		$this->sheets = [];
	}

	public function setAuthor($author){
    $this->author = $author;
  }

	public function setIndex($index){
    $this->index = $index;
  }

	public function setYear($year){
    $this->year = $year;
  }

	public function setSheets($sheets){
    $this->sheets = $sheets;
  }

	public function description()
  {
    $description = "<h1>Las caracteristicas del libro son:</h1>";
		$description .= "Author: " . $this->getAuthor();
		$description .= "<br/> Year: " . $this->getYear();
		//parent::description(); //llamando en forma recursiva al mísmo método.
		
		echo $description;
  }

	public function addChapter($nameChapter, $sheetsChapter){
		$info = array_push($this->index, $nameChapter);
		$info = array_push($this->sheets, $sheetsChapter);
		
		return $info;
	}

	public function getChapters(){
		echo "# de capitulos: " . count($this->index) . "</br>";
		$this->index = [];
	}

	public function getChapterName($numberChapter){
		foreach ($this->index as $key => $value) {
			if ($key == $numberChapter){
				echo "Capitulo " . "<b>" . $value . "</b>" . " seleccionado" . "</br>";
			}
		}
	}

	public function averageSheetsPerChapter(){
		try {
			$sum = array_sum($this->sheets);
			$totalChapters = count($this->index);
			$media = $sum/$totalChapters;

			if ($totalChapters == 0){
      	throw new \Exception(0);
    	}

			echo $media;
			
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
}

$book = new Book();

//var_dump($book->getAuthor());
//$book->description();
/*$book->addChapter("capitulo 1", 25);
$book->addChapter("capitulo 3", 35);
$book->addChapter("capitulo 2", 12);
$book->getChapters();
$book->getChapterName(1);
$book->averageSheetsPerChapter();*/