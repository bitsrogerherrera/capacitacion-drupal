<?php
require "product.php";
/**
 * PHP version 7
 *
 * @category Taller03
 * @package  Taller03
 * @author   Daniel Gomez <daniel.gomez@bitsamericas.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

namespace taller03\book;

/**
 * Book class extendes of product
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
class Book extends Product
{
    protected $author = '';
    protected $index = [
        "1" => "Preparando el entorno de desarrollo para programar en Drupal y PHP",
        "2" => "Servidores web AMP (Apache + MySQL + PHP)",
        "3" => "Introducción a la consola de Linux",
        "4" => "Introducción al control de verrsiones con Git",
        "5" => "PHP I: Introducción a PHP",
        "6" => "PHP II: Funciones de la API de PHP",
        "7" => "PHP III: Programación orientada a objetos (POO)",
        "8" => "PHP IV: Patrones de diseño",
        "9" => "MySQL I: Introducción a SQL y MySQL",
        "10" => "MySQL II: Herramientas de gestión de la base de datos",
        "11" => "Symfony I: Introducción a Symfony",
        "12" => "Symfony II: Componentes de Symfony"
    ];
    protected $year = '';
    protected $sheets = [];

    /**
     * Set arguments for de constructs
     */
    public function __construct()
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $method_name = '__construct' . $number_of_arguments;
        if (method_exists($this, $method_name)) {
            call_user_func_array(
                [$this, $method_name], $get_arguments
            );
        }
    }

    /**
     * Set standar title and price for de producto
     *
     * @return void
     */
    public function __construct1()
    {
        $this->title = 'Estandar';
        $this->price = 1000;
    }

    /**
     * Set author and year of the book
     *
     * @param string $author author of book
     * @param string $year year of book
     *
     * @return void
     */
    public function __construct2($author, $year)
    {
        $this->author = $author;
        $this->year = $year;
    }

    /**
     * Undocumented function
     */
    public function __destruct()
    {
        print "Libro eliminado";
    }

    /**
     * Get index of book
     *
     * @return index book
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set index of book
     *
     * @param string $index of book
     *
     * @return void
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }


    /**
     * Get author of book
     *
     * @return author book
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author of book
     *
     * @param string $author of book
     *
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get year of book
     *
     * @return year book
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set year of book
     *
     * @param string $year of book
     *
     * @return void
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * Get sheets of book
     *
     * @return sheets book
     */
    public function getSheets()
    {
        return $this->sheets;
    }

    /**
     * Set sheets of book
     *
     * @param string $sheets of book
     *
     * @return void
     */
    public function setSheets($sheets)
    {
        $this->sheets = $sheets;
    }

    /**
     * Get description of book
     *
     * @return description pruduct
     */
    public function description()
    {
        return "Libro ". $this->index .", autor: ".$this->author;
    }

    /**
     * Function for add chapter in the book
     *
     * @param string $nameChapter name of book
     * @param string $sheetsChapter pages of book
     *
     * @return void
     */
    public function addChapter($nameChapter, $sheetsChapter)
    {
        array_push($this->index, $nameChapter);
        array_push($this->sheets, $sheetsChapter);
    }

    /**
     * Get chapters of the book
     *
     * @return chapters of book
     */
    public function getChapters()
    {
        return "El total de capitulos del libro es: ".count($this->index);
    }

    /**
     * Get name chapters of the book with number
     *
     * @param int $chapterNumber of book
     *
     * @return void
     */
    public function getChapterName($chapterNumber)
    {
        foreach ($this->index as $key => $value) {
            if ($key == $chapterNumber) {
                return "El nombre del capitulo es: ".$value;
            }
        }
    }

    /**
     * Get the average number of sheets per chapter
     *
     * @return average
     */
    public function averageSheetsPerChapter()
    {
        try{
            $totalSheets = array_sum($this->sheets);
            $totalChapters = count($this->index);
            $average = $sum/$totalChapters;
            if ($totalChapters == 0) {
                throw new \Exception(0);
            }
            return $average;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}