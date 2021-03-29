<?php
require "book.php";
/**
 * PHP version 7
 *
 * @category Taller03
 * @package  Taller03
 * @author   Daniel Gomez <daniel.gomez@bitsamericas.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

namespace taller03\library;

/**
 * Library class extendes of book
 *
 * @category Taller03

 * @package Taller03
 *
 * @author Daniel Gomez <daniel.gomez@bitsamericas.com>
 *
 * @copyright 2021 BitsAmericas
 *
 * @license https://github.com/bitsrogerherrera/capacitacion-drupal BitsAmericas Licence
 *
 * @link None
 */
class Library extends Book
{
    protected $books;

    /**
     * Set arguments for de constructs
     */
    public function __construct()
    {
        $getBooks = file_get_contents("public/books.json");
        $this->books = json_decode($getBooks);
    }

    /**
     * Get title book
     *
     * @param int $index of book
     *
     * @return void
     */
    public function getTitleBook($index)
    {
        return $this->books[$index]->title;
    }

    /**
     * Get author book
     *
     * @param int $index of book
     *
     * @return void
     */
    public function getAuthorBook($index)
    {
        return $this->books[$index]->author;
    }

    /**
     * Get year book
     *
     * @param int $index of book
     *
     * @return void
     */
    public function getYearBook($index)
    {
        return $this->books[$index]->year;
    }

    /**
     * Get Chapter book
     *
     * @param int $index of book
     *
     * @return void
     */
    public function getChapterBook($index)
    {
        return $this->books[$index]->chapters;
    }

    /**
     * Get Chapter book
     *
     * @param int $index of book
     *
     * @return void
     */
    public function getChapterBook($index)
    {
        return $this->books[$index]->chapters;
    }

    /**
     * Get count chapters book
     *
     * @return void
     */
    public function getCountChapterBook()
    {
        foreach ($this->books as $key => $value) {
            echo "El libro ".$key->title." tiene " .
            count($title->chapters) .
            " capitulos";
        }
    }

    /**
     * Get random chapters book
     *
     * @return void
     */
    public function getRandomChapterBook()
    {
        $chapters = [];
        $resultChapters = [];
        foreach ($this->books as $key => $value) {
            array_push($chapters, $title->chapters);
        }

        for ($i = 0; $i < count($chapters); $i++) {
            $randomNumber = $randomKeys = rand(0, count($listBooks[$i]) - 1);
            array_push($resultChapters, $chapters[$randomNumber]);
        }
        var_dump($resultChapters);
    }

    /**
     * Get pages for chapter books
     *
     * @return void
     */
    public function getPagesChapterBook()
    {
        foreach ($this->books as $key => $value) {
            echo "El libro ".$key->title." tiene " .
            number_format($this->books[$key]->averageSheetsPerChapter(), 0) .
            " paginas";
        }
    }

    /**
     * Get pages for chapter books
     *
     * @return void
     */
    public function jsonBook()
    {
        foreach ($this->books as $key => $value) {
            echo json_encode(($this->books[$key]));
        }
    }

    /**
     * Get pages for chapter books
     *
     * @return void
     */
    public function destroyBooks()
    {
        foreach ($this->books as $key => $value) {
            unset($books[$key]);
        }
    }
}