<?php
use taller04\Library\Library;
require_once("Library.php");
$library = new Library;
$array = $library->saveOneBook();
$errorName = $array[0];
$save =$array[1];
$errorSave = $array[2];
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
  <div class="container mt-4">
    <div class="row">
      <div class="col-12">
        <a href="index.php">Regresar</a>
      </div>
    </div>
    <form action="#" method="POST">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Nombre</label>
          <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Nombre libro">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Autor</label>
          <input type="text" name="author" class="form-control" id="inputPassword4" placeholder="Autor">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Precio</label>
          <input type="number" name="price" class="form-control" id="inputEmail4" placeholder="Precio del libro">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Año</label>
          <input type="number" name="year" class="form-control" min="1700" max="2050" id="inputPassword4" placeholder="YYYY">
        </div>
      </div>

      <button type="submit" name="crear" class="btn btn-primary">Guardar</button>
    </form>
    <div class="row">
      <div class="col">
        <p class="text-danger"><?php echo $errorName; ?></p>
        <p class="text-success"><?php echo $save; ?></p>
        <p class="text-danger"><?php echo $errorSave; ?></p>
      </div>
    </div>

  </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
