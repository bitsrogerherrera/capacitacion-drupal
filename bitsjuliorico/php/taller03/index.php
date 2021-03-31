<?php

use taller03\Book\Book;
use taller03\Library\Library;

require('Book.php');
require('Library.php');
$library = new Library();
// $library->printBooks();
// $library->printChapterBooks();s
// $library->randonChapterBooks();
$library->printJson();




// $book1 = new Book();
// $book1->setName('Cien años de soledad');
// $book1->setPrice(120000);
// $average1 = $book1->averageSheetsPerChapter();
// print "\nEl promedio 1 de hojas es: $average1";
// $book1->addChapter('Capitulo 1', 10);
// $book1->addChapter('Capitulo 2', 20);
// $descripction = $book1->description();
// print "\nLa descripción es: $descripction";

// $capther = $book1->getChapterName(1);
// print "\nEl capitulo es: $capther";

// $average = $book1->averageSheetsPerChapter();
