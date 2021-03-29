<?php 

namespace Capacitacion\Php;

require_once "Book.php";

class Read extends Book{

	protected $book = [];

	public function __construct($name = "", $price = ""){
		$this->name = $name;
		$this->price = $price;
	}

	public function readFile(){
		$results = [];
		$data = file_get_contents("libros.json");
		$books = json_decode($data, true);
 
		foreach ($books as $book) {
			foreach ($book as $items) {
				$results[] = $items;
			}
		}

		return $results;
	} 

	public function randChapters($chapters){
		$chapter = array_rand($chapters, 3);
		$result = "<h3>Capitulos aleatorios.</h3>";
		$result .= $chapter[0]. "</br>";
		$result .= $chapter[1]. "</br>";
		$result .= $chapter[2]. "</br>";
		return $result;
	}
}

$read = new Read();
$books = $read->readFile();
foreach ($books as $book) {
	$read->setAuthor($book["author"]);
	$read->setYear($book["year"]);
	$read->getSheets();
	$read->description();
	if(isset($book["chapters"])){
		foreach ($book["chapters"] as $chapters => $sheets) {
			$read->addChapter($chapters, $sheets);
		}
		echo $read->randChapters($book["chapters"]);
		$read->getChapters();
	}
}

