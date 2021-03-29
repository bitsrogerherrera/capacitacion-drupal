<?php 

namespace Capacitacion\Php;

use Capacitacion\DB\Requests;

require_once "Book.php";
require_once "db/Requests.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Read extends Book{

	protected $book = [];

	public function __construct($name = "", $price = ""){
		$this->name = $name;
		$this->price = $price;
	}

	public function readFile(){
		$results = [];
		$data = file_get_contents("resources/libros.json");
		$books = json_decode($data, true);

		$request = new Requests();
		foreach ($books as $book) {
			foreach ($book as $items) {
				$request->getAddBooks($items);
				$results[] = $items;
			}
		}

		echo "Libros Guardados Correctamente en la BD";
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
$read->readFile();
$request = new Requests();
$books = $request->getAllBooks();
echo "<h1>Las caracteristicas de los libros son: </h1>";
foreach ($books as $book) {
	echo "<b>Name: </b>" . $book->name . "</br>";
	echo "<b>Price: </b>" . $book->price . "</br>";
	echo "<b>Author: </b>" . $book->author . "</br>";
	echo "<b>Year: </b>" . $book->year . "</br>";
	
	if($book->chapters != null){
		foreach (json_decode($book->chapters) as $chapters => $sheets) {
			$read->addChapter($chapters, $sheets);
		}
		echo $read->getSheets();
		echo "<hr>";
	}else{
		echo "<b>libro sin capitulos</b></br>";
		echo "<hr>";
	}
}
