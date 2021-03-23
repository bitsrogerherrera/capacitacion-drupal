<?php

require('Book.php');
use App\Product\Book as Book;

const QUANTITIES_BOOKS = 3;


$books = [];
innitiallice_books_array($books);
$books_contents = read_data_from_json($books);
fill_books_info($books, $books_contents);
print_books_properties($books);
print_books_chapters_count($books);
print_random_chapters_name($books);
print_books_avg_pages_chapters($books);
print_books_to_json($books);
destroy_books($books);

function innitiallice_books_array(&$books)
{
    for ($i = 0; $i < QUANTITIES_BOOKS; $i++) {
        $books[] = new Book();
    }
}

function read_data_from_json()
{
    $file = "books.json";
    $content = file_get_contents($file);
    $book_data = json_decode($content);
    return $book_data;
}

function fill_books_info(&$books, $book_data)
{
    $fill_option = $_GET["constructor"];
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

function print_books_properties($books)
{
    for ($i = 0; $i < count($books); $i++) {
        if ($books[$i]->getIndex() === null || $books[$i]->getIndex() % 2 === 0) {
            printf(
                "El libro %s del autor %s, publicado el año %s, tiene %d paginas y %d capitulos. Su precio es %s \n",
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

function print_books_chapters_count($books)
{
    for ($i = 0; $i < count($books); $i++) {
        print(" El libro tiene " . $books[$i]->getChapters() . " capitulos \n");
    }
}

function print_books_avg_pages_chapters($books)
{
    for ($i = 0; $i < count($books); $i++) {
        print("Las paginas promedio por capitulo son: " .
        number_format($books[$i]->averageSheetsPerChapter(), 2) .
        "\n");
    }
}

function print_random_chapters_name($books)
{
    for ($i = 0; $i < count($books); $i++) {
        if ($books[$i]->getChapters() > 0) {
            $j = 0;
            while ($j < QUANTITIES_BOOKS) {
                $random_index = rand(0, $books[$i]->getChapters() - 1);
                print("El capitulo se llama: " . $books[$i]->getChapterName($random_index) . "\n");
                $j++;
            }
        } else {
            print("No hay data de capitulos en el libro \n");
        }
    }
}

function print_books_to_json($books)
{
    for ($i = 0; $i < count($books); $i++) {
        print(json_encode($books[$i], JSON_PRETTY_PRINT) . "\n");
    }
}

function destroy_books(&$books)
{
    for ($i = 0; $i < QUANTITIES_BOOKS; $i++) {
        unset($books[$i]);
    }
}
