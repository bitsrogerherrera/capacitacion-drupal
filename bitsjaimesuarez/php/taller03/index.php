<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  //require_once 'product.php';
  //require_once 'book.php';
  require_once 'action.php';
  use Taller03\Product\ActionReadExecute;

  /*$book = new Book();
  $book->setName('Del amor y otros demonios');
  $book->setPrice('$40.500');

  $book->setAuthor('Gabriel García Márquez');
  $book->setYear('1967');

  $book->addChapter('Un perro cenizo con un lucero en la frente', '23');
  $book->addChapter('Nunca se supo cómo había llegado el marqués', '27');
  $book->addChapter('El convento de Santa Clara era un edificio cuadrado frente al mar', '36');*/

  $action = new ActionReadExecute();
  $action->loadInfoJson();
?>

<!--<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>taller03: PHP (Caps: 5,6 y 7)</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    footer {
      background-color: black;
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 40px;
      color: white;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> //fixed-top
    <div class="container">
      <a class="navbar-brand" href="#">PHP</a>
    </div>
  </nav>

  <div style="margin: 60px 0"></div>

  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <h1 class="my-4">Taller 03</h1>
        <div class="list-group">
          <a href="#" class="list-group-item active">taller 03</a>
        </div>
      </div>

      <div class="col-lg-9" style="margin-top: 70px">
        <div class="card card-outline-secondary my-4">
          <div class="card-header">
          <h5>Listado de Productos</h5>
          </div>
          <div class="card-body">
            <h5>Libro:</h5>
            <?php

            ?>
            <ul>
              <?php $action->description(); ?>
              <ul>
                <li><?php $action->getChapters(); ?></li>
                <li><?php $action->getChapterName(1); ?></li>
                <li><?php $action->averageSheetsPerChapter(); ?></li>
              </ul>
            </ul>

            <hr>
          </div>
        </div>

      </div>
    </div>
  </div>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Capacitación Drupal</p>
    </div>
  </footer>

  //Bootstrap core JavaScript
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html> -->