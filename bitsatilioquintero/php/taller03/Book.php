<?php

namespace App\Product;

use Exception;

require('Product.php');

class Book extends Product implements \JsonSerializable
{
    protected $author;
    protected $index;
    protected $year;
    protected $sheets;

    public function __construct($author = null, $year = null, $name = null, $price = null)
    {
        parent::__construct($name, $price);
        if (isset($author)) {
            $this->author = $author;
        }
        if (isset($year)) {
            $this->year = $year;
        }
    }

    public function __destruct()
    {
        print("Destroying Book: " . $this->name . "<br>");
    }

    public function description()
    {
        $text = "The book name is %s, the author is %s, published in %s, with a page count of %d " .
        "and their price is %d <br>";
        printf(
            $text,
            $this->name,
            $this->author,
            $this->year,
            $this->sheets,
            $this->price
        );
    }

    public function addChapter($chapterTitle, $chapterPages)
    {
        $this->index[] = $chapterTitle;
        $this->sheets += $chapterPages;
    }

    public function getChapters()
    {
        if (!isset($this->index)) {
            return 0;
        }
        return count($this->index);
    }

    public function getChapterName($indexToSearch)
    {
        return $this->index[$indexToSearch];
    }

    public function averageSheetsPerChapter()
    {
        $average = -1;
        try {
            if (!isset($this->index)) {
                throw new Exception("No existen indices");
            }
            if (count($this->index) === 0) {
                throw new Exception("division por cero");
            }
            $average = $this->sheets / count($this->index);
        } catch (\Throwable $th) {
            $average = 0;
        }
        return $average;
    }

    public function getAuthor()
    {
        return htmlentities($this->author);
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getSheets()
    {
        return $this->sheets;
    }

    public function setSheets($sheets)
    {
        $this->sheets = $sheets;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        $vars["author"] = htmlentities($vars["author"]);
        $vars["name"] = htmlentities($vars["name"]);
        return $vars;
    }

    public function __toString()
    {
        return "The book name is " . $this->name . " the author is " . $this->author .
        ", published in " . $this->year . ", with a page count of " . $this->sheets .
        " and their price is " . $this->price . "<br>";
    }
}
