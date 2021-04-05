<?php

namespace indexMain;

require "clases/book.php";

use bookMain\Book as Book;

class Index
{
    public $newArrayBook = [];
    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        $this->books = file_get_contents("json/book.json");
        $this->books = json_decode($this->books);
        $this->readBooksData($this->books);
    }

    public function readBooksData($books, $option = true)
    {
        if (boolval($option)) {
            foreach ($books as $key => $value) {
                $booksRead = new Book();
                $booksRead->setTitle($value->book->title);
                $booksRead->setAutor($value->book->author);
                $booksRead->setYear($value->book->year);
                $booksRead->setIndex($value->book->chapters);
                $booksRead->setSheets($value->book->sheets);
                array_push($this->newArrayBook, $booksRead);
            }
        } else {
            foreach ($books as $key => $value) {
                $booksRead = new Book($value->book->title, $value->book->author, $value->book->year);
                $booksRead->setIndex($value->book->chapters);
                array_push($this->newArrayBook, $booksRead);
            }
        }
    }

    public function printBooks()
    {
        foreach ($this->newArrayBook as $key => $value) {
            $listBooks = [];
            if ($key % 2 == 0) {
                array_push($listBooks, $value);
                print("------------------------");
                print_r($listBooks);
            } else {
                $this->__get($key);
            }
        }
    }
    public function __get($key)
    {
        return $this->books[$key];
    }

    public function listBooks()
    {
        $dataBooks = $this->books;
    }

    public function chaptersPerBook()
    {

        foreach ($this->newArrayBook as $key => $value) {
            print("Nombre de la obra:\n\n");
            print_r($value->getTitle());
            print("\nCantidad de capitulos: ");
            print_r(count($value->getIndex()));
            print("\n---------------------\n");
        }
    }

    public function randomObtainChapters()
    {
        $listBooks = [];
        foreach ($this->newArrayBook as $key1 => $book) {
            $listChapters = $book->getIndex();
            if (!empty($listChapters)) {
                array_push($listBooks, $listChapters);
            }
        }
        for ($i = 0; $i < count($listBooks); $i++) {
            $newRandowChapters = [];
            for ($j = 0; $j < 3; $j++) {
                $randomKeys = rand(0, count($listBooks[$i]) - 1);
                array_push($newRandowChapters, $listBooks[$i][$randomKeys]);
            }
            print_r($newRandowChapters);
        }
    }
}
// $book = new Index(boolval($_GET["option"]));
// $book = new index();
// $book->randomObtainChapters();
// $book->printBooks();
// $book->randomObtainChapters();
// unset($book);
