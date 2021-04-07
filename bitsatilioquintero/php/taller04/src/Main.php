<?php

namespace Main;

require('book/Book.php');
use App\Product\Book as Book;

class Main
{
    private const QUANTITIES_BOOKS = 3;

    public function doTask()
    {
        $books = [];
        $this->innitialliceBooksArray($books);
        $books_contents = $this->readDataFromJson($books);
        $this->fillBooksInfo($books, $books_contents);

        return $books;
    }

    public function innitialliceBooksArray(&$books)
    {
        for ($i = 0; $i < self::QUANTITIES_BOOKS; $i++) {
            $books[] = new Book();
        }
    }

    public function readDataFromJson()
    {
        $file = $_SERVER["DOCUMENT_ROOT"] . "/json/books.json";
        $content = file_get_contents($file);
        $book_data = json_decode($content);
        return $book_data;
    }

    public function fillBooksInfo(&$books, $book_data)
    {
        $fill_option = (int) $_GET["constructor"];
        foreach ($book_data as $key => $value) {
            if ($fill_option === 2) {
                $books[$key]->setAuthor($value->{'author'});
                $books[$key]->setName($value->{'name'});
                $books[$key]->setPrice($value->{'price'});
                $books[$key]->setSheets($value->{'sheets'});
                $books[$key]->setYear($value->{'year'});
                if (isset($value->{'index'})) {
                    $books[$key]->setIndex($value->{'index'});
                }
            } else {
                $books[$key] = new Book(
                    $value->{'author'},
                    $value->{'year'},
                    $value->{'name'},
                    $value->{'price'}
                );
                $books[$key]->setSheets($value->{'sheets'});
                if (isset($value->{'index'})) {
                    $books[$key]->setIndex($value->{'index'});
                }
            }
        }
    }

    public function printBooksProperties($books)
    {
        for ($i = 0; $i < count($books); $i++) {
            if ($books[$i]->getChapters() % 2 === 0) {
                $text = "El libro %s del autor %s, publicado el año %s, tiene %d paginas y %d capitulos." .
                " Su precio es %s <br>";
                printf(
                    $text,
                    $books[$i]->getName(),
                    $books[$i]->getAuthor(),
                    $books[$i]->getYear(),
                    $books[$i]->getSheets(),
                    $books[$i]->getChapters(),
                    $books[$i]->getPrice()
                );
            } else {
                print($books[$i]);
            }
        }
    }

    public function printBooksChaptersCount($books)
    {
        for ($i = 0; $i < count($books); $i++) {
            print(" El libro " . $books[$i]->getName() .
            " tiene " .
            $books[$i]->getChapters() .
            " capitulos <br>");
        }
    }

    public function printBooksAvgPagesChapters($books)
    {
        for ($i = 0; $i < count($books); $i++) {
            print("Las paginas promedio por capitulo del libro " .
            $books[$i]->getName() .
            " son: " .
            number_format($books[$i]->averageSheetsPerChapter(), 2) .
            "<br>");
        }
    }

    public function printRandomChaptersName($books)
    {
        for ($i = 0; $i < count($books); $i++) {
            print("El libro se llama: " . $books[$i]->getName() . "<br>");
            if ($books[$i]->getChapters() > 0) {
                $j = 0;
                while ($j < self::QUANTITIES_BOOKS) {
                    $random_index = rand(0, $books[$i]->getChapters() - 1);
                    print("El capitulo se llama: " .
                    $books[$i]->getChapterName($random_index) .
                    "<br>");
                    $j++;
                }
            } else {
                print("No hay información de capitulos en el libro <br>");
            }
        }
    }

    public function printBooksToJson($books)
    {
        for ($i = 0; $i < count($books); $i++) {
            print(json_encode($books[$i], JSON_PRETTY_PRINT) . "<br>");
        }
    }

    public function destroyBooks(&$books)
    {
        for ($i = 0; $i < self::QUANTITIES_BOOKS; $i++) {
            unset($books[$i]);
        }
    }

    public function createNewBook()
    {
        $book = new Book();
        if (isset($_POST['bookName'])) {
            $book->setName($_POST['bookName']);
        }
        if (isset($_POST['bookAuthor'])) {
            $book->setAuthor($_POST['bookAuthor']);
        }
        if (isset($_POST['bookPrice'])) {
            $book->setPrice($_POST['bookPrice']);
        }
        if (isset($_POST['bookPages'])) {
            $book->setSheets($_POST['bookPages']);
        }
        if (isset($_POST['bookYear'])) {
            $book->setYear($_POST['bookYear']);
        }
        $this->setNewBookChapters($book);
        return $book;
    }

    private function setNewBookChapters(&$book)
    {
        $chapters = [];
        $index = [];
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'chapter') !== false) {
                $chapters[] = $key;
            }
        }
        foreach ($chapters as $key) {
            $value = $_POST[$key];
            $order = substr($key, 7);
            $index[$order - 1] = $value;
        }
        $book->setIndex($index);
    }
}
