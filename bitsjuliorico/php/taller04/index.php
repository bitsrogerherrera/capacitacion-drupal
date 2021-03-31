<?php

use taller04\Library\Library;

require_once("ConnectDb.php");
require("Library.php");
$library = new Library;
$books = $library->getAllBooksDb();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Books</title>
</head>

<body>
  <div class="container">
    <div class="row mt-4">
      <div class="col-6">
      <button class="btn btn-primary">
        <a href="crear.php" class="text-white">Crear libro</a>
      </button>
      </div>
      <div class="col-6">
        <form action="#" method="post">
          <button type="submit" name="cargar" class="btn btn-primary">Cargar desde Json</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Autor</th>
              <th scope="col">Precio</th>
              <th scope="col">Año</th>
              <th scope="col">Capitulos</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($books as $key => $book) : ?>
            <tr>
              <th scope="row"><?php echo $book["id"]; ?></th>
              <td><?php echo $book["name"]; ?></td>
              <td><?php echo $book["author"]; ?></td>
              <td><?php echo $book["price"]; ?></td>
              <td><?php echo $book["year"]; ?></td>
              <td><?php echo $book["chapters"]; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>