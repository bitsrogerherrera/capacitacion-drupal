<?php

namespace bookMain;

require_once "product.php";

use DivisionByZeroError;
use Exception;
use productoMain\Product;


class Book extends Product
{
    protected $autor = '';
    protected $index = [];
    protected $year = '';
    protected $sheets = 0;

    public function __construct()
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $method_name = '__construct' . $number_of_arguments;
        if (method_exists($this, $method_name)) {
            call_user_func_array(
                [$this, $method_name],
                $get_arguments
            );
        } else {
            $this->title = 'undefined';
            $this->autor = 'undefined';
            $this->year = 'undefined';
        }
    }
    public function __construct1($title, $autor, $year)
    {
        $this->title = $title;
        $this->autor = $autor;
        $this->year = $year;
    }

    public function __destruct()
    {
        echo "El producto de nombre" . $this->title . "fue eliminado! \n";
    }

    public function description()
    {
        parent::description();
        echo "El producto con nombre: " . $this->title . "" . $this->description . "del autor: " . $this->autor . "del año: " . $this->year . "\n";
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getSheets()
    {
        return $this->sheets;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setAutor($autor)
    {
        return $this->autor = $autor;
    }

    public function setYear($year)
    {
        return $this->year = $year;
    }

    public function setSheets($sheets)
    {
        return $this->sheets = $sheets;
    }

    public function setIndex($index)
    {
        return $this->index = $index;
    }

    public function addChapter($name_cap, $sheets_cap)
    {
        array_push($this->index, [$name_cap, count($this->index)]);
        $this->sheets += $sheets_cap;
    }

    public function getChapters()
    {
        if (is_null($this->index)) {
            return 0;
        }
        return count($this->index);
    }

    public function getChapterName($searchIndex)
    {
        return $this->index[$searchIndex];
    }

    public function averageSheetsPerChapter()
    {
        try {
            if (!isset($this->index)) {
                return 0;
            }
            $averageSheets =  $this->sheets / count($this->index);
            return $averageSheets;
        } catch (DivisionByZeroError $e) {
            return 0 . "\n";
        } catch (Exception $e) {
            return 0 . "\n";
        }
    }
}

// $book = new book();
// $book->setTitle('El hoobit');
// print $book->averageSheetsPerChapter();
// unset($book);
