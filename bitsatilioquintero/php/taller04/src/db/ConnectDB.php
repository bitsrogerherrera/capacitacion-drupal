<?php

namespace App\DB;

use PDO;
use PDOException;

class ConnectBD
{
    private $connection;
    private static $instance;

    private function __construct()
    {
        $user = 'prueba';
        $pass = 'Bits2020<>';
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=ejemplosimf', $user, $pass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            ));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnectBD();
        }
        return self::$instance;
    }

    public function hello()
    {
        foreach ($this->connection->query('select curdate()') as $row) {
            print_r($row[0]);
        }
    }

    public function insertBook($book)
    {
        $insertBook = 'INSERT INTO ejemplosimf.Book
        (Title, Author, YearPublication, TotalPages, Price)
        VALUES(?, ?, ?, ?, ?)';
        $statement = $this->connection->prepare($insertBook);
        $result = $statement->execute([
            html_entity_decode($book->getName()),
            html_entity_decode($book->getAuthor()),
            $book->getYear(),
            $book->getSheets(),
            $book->getPrice()]);
        if (!$result) {
            print('Fallo la inserción del libro');
        }
    }

    public function insertChapter($chapterName, $position, $bookId)
    {
        $insertChapter = 'INSERT INTO ejemplosimf.Chapter
        (Name, ChapterNumber, BookId)
        VALUES(?, ?, ?)';
        $statement = $this->connection->prepare($insertChapter);
        $result = $statement->execute([
            $chapterName,
            $position,
            $bookId
        ]);
        if (!$result) {
            print('Fallo la inserción del capitulo');
        }
    }

    public function getBookIdByTitle($bookName)
    {
        $id = -1;
        $selectIdBook = 'SELECT Id FROM ejemplosimf.Book WHERE Title = ?';
        $statement = $this->connection->prepare($selectIdBook);
        $statement->execute([html_entity_decode($bookName)]);
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["Id"];
            break;
        }
        return $id;
    }

    public function getBookTitleById($bookId)
    {
        $selectIdBook = 'SELECT Title FROM ejemplosimf.Book WHERE Id = ?';
        $statement = $this->connection->prepare($selectIdBook);
        $statement->execute([html_entity_decode($bookId)]);
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return $row["Title"];
        }
    }

    public function getAllBooks()
    {
        $books = [];
        $selectBooks = 'SELECT * FROM ejemplosimf.Book';
        $statement = $this->connection->prepare($selectBooks);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $books[] = $row;
        }
        return $books;
    }

    public function getBookChapters($bookId)
    {
        $chapters = [];
        $selectChapters = 'SELECT * FROM ejemplosimf.Chapter WHERE BookId = ? ORDER BY ChapterNumber ASC';
        $statement = $this->connection->prepare($selectChapters);
        $statement->execute([$bookId]);
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $chapters[] = $row;
        }
        return $chapters;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
