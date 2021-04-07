<?php

require('Main.php');
require('db/ConnectDB.php');

use App\DB\ConnectBD;
use Main\Main as Main;

$headHTML = <<<EOD
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="shortcut icon" href="/favicon.ico">
    <title>Lista de Libros!</title>
  </head>
  <body class="h-100 d-flex text-center">
        <div class="container">
EOD;
$headerBookTable = <<<EOD
<div class="col-sm">
<h2>Listado de libros</h2>
</div>
<form action="/src/index.php" method="get">
<table class="table">
<thead>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Autor</th>
        <th scope="col">Año</th>
        <th scope="col">Precio</th>
        <th scope="col">Hojas</th>
        <th scope="col"></th>
    </tr>
</thead>
<tbody>
EOD;
$footerTable = <<<EOD
</tbody>
</table>
<input type="hidden" name="BookIdToSend" id="bookIdToSend" value="" />
</form>
EOD;
$footerChapterTable = <<<EOD
</tbody>
</table>
<button type="submit" class="btn btn-primary">Regreso al menú anterior</button>
</form>
EOD;
$footer = <<<EOD
</div>
<script type="text/javascript">
    function setBook(id){
        document.getElementById('bookIdToSend').value = id;
    }
</script>
</body></html>
EOD;
$headerChapterTable = <<<EOD
<div class="col-sm">
    <h2>Listado de Capitulos del libro %s</h2>
</div>
<form id="lol" action="/src/index.php" method="get">
    <div class="col-6" style="margin: 0 auto;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                </tr>
            </thead>
            <tbody>
EOD;
$messageBookCreated = <<<EOD
<form action="/src/index.php" method="get">
<h2>Libro Creado %s</h2>
<button type="submit" class="btn btn-primary">Listado de libros</button>
</form>
EOD;
function insertRecordsFromJSON()
{
    $program = new Main();
    $books = $program->doTask();
    try {
        foreach ($books as $book) {
            insertBook($book);
        }
    } catch (Exception $e) {
        print('<p>' . $e->getMessage() . '</p>');
    }
}

function insertBook($book)
{
    ConnectBD::getInstance()->insertBook($book);
    if ($book->getChapters() > 0) {
        $bookid = ConnectBD::getInstance()->getBookIdByTitle($book->getName());
        if ($bookid < 1) {
            throw new Exception("No se recupero id válido de libro " . $book->getName());
        }
        $i = 1;
        foreach ($book->getIndex() as $chapter) {
            ConnectBD::getInstance()->insertChapter($chapter, $i, $bookid);
            $i++;
        }
    }
}

function listBooks()
{
    try {
        $books = ConnectBD::getInstance()->getAllBooks();
        foreach ($books as $book) {
            print('<tr>');
            print('<td>' . $book['Title'] . '</td>');
            print('<td>' . $book['Author'] . '</td>');
            print('<td>' . $book['YearPublication'] . '</td>');
            print('<td>' . $book['Price'] . '</td>');
            print('<td>' . $book['TotalPages'] . '</td>');
            print("<td><button type='submit' id='book" . $book['Id'] .
            "' class='btn btn-primary' onclick='setBook(this.id)'>Ver Capitulos</button></td>");
            print('</tr>');
        }
    } catch (Exception $e) {
        print('<p>' . $e->getMessage() . '</p>');
    }
}

function getBookName($rawBookId)
{
    $bookId = substr($rawBookId, 4);
    return ConnectBD::getInstance()->getBookTitleById($bookId);
}

function listChapters($rawBookId)
{
    $bookId = substr($rawBookId, 4);
    try {
        $chapters = ConnectBD::getInstance()->getBookChapters($bookId);
        if (count($chapters) > 0) {
            foreach ($chapters as $chapter) {
                print('<tr>');
                print('<td>' . $chapter['ChapterNumber'] . '</td>');
                print('<td>' . $chapter['Name'] . '</td>');
                print('</tr>');
            }
        } else {
            print('<tr>');
            print('<td colspan="2">No hay registros</td>');
            print('</tr>');
        }
    } catch (Exception $e) {
        print('<p>' . $e->getMessage() . '</p>');
    }
}

function createBook()
{
    $program = new Main();
    $book = $program->createNewBook();
    try {
        insertBook($book);
    } catch (Exception $e) {
        print('<p>' . $e->getMessage() . '</p>');
    }
    return $book;
}
