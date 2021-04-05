<?php
/**
 * Clase ReadBook
 */

/**
 * Class ReadBook
 */
class Libros
{

    protected array $idBook = [];
    protected array $nameBook = [];
    protected array $numChapter = [];
    protected array $nameChapter = [];

    /**
     * ReadBook constructor.
     */
    public function __construct()
    {
        $this->idBook;
        $this->numChapter;
        $this->nameBook;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        print "<br>" . "ReadBook eliminados.";
    }

    /**
     * @return array
     */
    public function getIdBook(): array
    {
        return $this->idBook;
    }

    /**
     * @param array $idBook
     */
    public function setIdBook(array $idBook): void
    {
        $this->idBook = $idBook;
    }

    /**
     * @return array
     */
    public function getNameBook(): array
    {
        return $this->nameBook;
    }

    /**
     * @param array $nameBook
     */
    public function setNameBook(array $nameBook): void
    {
        $this->nameBook = $nameBook;
    }

    /**
     * @return array
     */
    public function getNumChapter(): array
    {
        return $this->numChapter;
    }

    /**
     * @param array $numChapter
     */
    public function setNumChapter(array $numChapter): void
    {
        $this->numChapter = $numChapter;
    }

    /**
     * @return array
     */
    public function getNameChapter(): array
    {
        return $this->nameChapter;
    }

    /**
     * @param array $nameChapter
     */
    public function setNameChapter(array $nameChapter): void
    {
        $this->nameChapter = $nameChapter;
    }

    /**
     * AllPropertiesBooks
     */
    public function allPropertiesBooks()
    {
        print "Id_Books: " . "<br>";
        print_r($this->getIdBook()); print "<br><br>";

        print "Names Books: " . "<br>";
        print_r($this->getNameBook()); print "<br><br>";

        print "Chapters Numbers". "<br>";
        print_r($this->getNumChapter()); print "<br><br>";

        print "Chapters Name: " . "<br>";
        print_r($this->getNameChapter()); print "<br><br>";
    }
}

$data = file_get_contents("./json/Libros.json");
$libros = json_decode($data, true);

$id_Book = [];
$name_Book = [];
$num_Chapter = [];
$name_chapter = [];

$libros1 = new Libros();

for ($i = 0; $i < count($libros); $i++) {
    if ($libros[$i]['id_book'] %2 == 0) {
        $id_Book[] = [$libros[$i]['id_book']];
        $name_Book[] = [$libros[$i]['nameBook']];
        $num_Chapter[] = [$libros[$i]['numChapter']];
        $name_chapter[] = [$libros[$i]['nameChapter']['namCap']];
    }
}

$libros1 -> setIdBook($id_Book);
$libros1 -> setNameBook($name_Book);
$libros1 -> setNumChapter($num_Chapter);
$libros1 -> setNameChapter($name_chapter);

$libros1 -> allPropertiesBooks();

print "Cantidad capitulos por libro: " . "<br>";
foreach ($libros as $indBook) {
    print $indBook['nameBook'] . ": ";
    print_r(count($indBook['numChapter']['ind_libro']));
    print "<br>";
}
print "<br>";

print "Capitulos por libro" . "<br>";
foreach ($libros as $chapPerBook) {
    print $chapPerBook['nameBook'] . ": ";
    print_r($chapPerBook['nameChapter']['namCap']);
    print "<br>";
}
print "<br>";

print "Paginas por capitulo por libro: " . "<br>";
foreach ($libros as $pagesPerChapter) {
    print_r($pagesPerChapter['numChapter']['ind_libro']);
}
print "<br><br>";

print "ReadBook en formato json" . "<br>";
foreach ($libros as $jsonBooks) {
    print json_encode($jsonBooks);
    print "<br><br>";
}