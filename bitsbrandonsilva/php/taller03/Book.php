<?php
/**
 * Clase Book
 */
require_once 'Product.php';

use Php\Product\Product;

/**
 * Class Book
 */
class Book extends Product
{
    protected string $author;
    protected int $year;
    protected string $sheets;

    protected array $index = array(
        array('numChapter' => 3, 'nameChapter' => 'El Gato Negro'),
        array('numChapter' => 10, 'nameChapter' => 'Los Anteojos'),
    );

    /**
     * Book constructor.
     *
     * @param $author
     * @param $year
     */
    public function __construct($author, $year)
    {
        $this -> author = $author;
        $this -> year = $year;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        print "del autor ". $this->getAuthor();
    }

    /**
     * @return mixed
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return array
     */
    public function getIndex(): array
    {
        return $this->index;
    }

    /**
     * @param array $index
     */
    public function setIndex(array $index): void
    {
        $this->index = $index;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getSheets()
    {
        return $this->sheets;
    }

    /**
     * @param mixed $sheets
     */
    public function setSheets($sheets): void
    {
        $this->sheets = $sheets;
    }

    /**
     * @return mixed|void
     */
    public function description()
    {
        echo 'DESCRIPTION: <br>';
        print 'Autor: ' . $this->getAuthor() . "<br>"
            . 'Año: ' . $this->getYear() . "<br>";
    }

    /**
     * @param $chapter
     */
    public function addChapter($chapter)
    {
        array_push($this->index, $chapter);
    }

    /**
     * GetChapters
     */
    public function getChapters()
    {
        for ($i = 0; $i < count($this->index); $i++) {
            $i;
        }

        print "Numero de Capitulos: " . $i  . "<br>";
    }

    /**
     * GetChaptersName
     */
    public function getChaptersName()
    {
        $chapterName = $this->index;
        $chapterFind = 35;

        echo "Buesqueda por Numero especifico: " . "<br>";
        foreach ($chapterName as $valor) {
            if ($valor['numChapter'] == $chapterFind) {
                print $valor['numChapter']. " " . $valor['nameChapter'] . "<br>";
            }
        }
    }

    /**
     * AveragerSheetsPerChapter
     */
    public function averageSheetsPerChapter()
    {
        $totalChapters = $this->index;
        $sum = 0;

        if (!$totalChapters) {
            print 0 . "<br>";
        } else {
            foreach ($totalChapters as $valor) {
                $sum = $sum + $valor['numChapter'];
            }
        }
        $average = $sum/ count($totalChapters);
        print "Promedio de hojas por capitulo: " . (int)$average;
    }
}

$book1 = new Book('Edgar Allan Poe', 1845);
$book1 -> description();

$book1 -> addChapter(
    array('numChapter' => 26, 'nameChapter' => 'El Asesinato En La Calle Morge')
);

$book1 -> addChapter(
    array('numChapter' => 35, 'nameChapter' => 'The Crow')
);

$book1 -> addChapter(
    array('numChapter' => 40, 'nameChapter' => 'El Pozo Y El Pendulo')
);

$book1 -> getChapters();
$book1 -> getChaptersName();
$book1 -> averageSheetsPerChapter();