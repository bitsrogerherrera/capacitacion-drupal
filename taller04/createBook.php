<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/estilos.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <title>crear Libro</title>
</head>
<body class="p-10">

  <form action="./createBook.php" method="get">
  <h3 class="text-secondary" style="margin: 20px 0;;">Información del libro</h3>
    <div class="form-group">
      <label for="exampleFormControlInput1">Titulo</label>
      <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Nombre del libro">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Author</label>
      <input type="text" name="author" class="form-control" id="exampleFormControlInput1" placeholder="Author">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Año</label>
      <input type="text" name="yearb" class="form-control" id="exampleFormControlInput1" placeholder="Año de publicaión">
    </div>
    <input class="btn btn-primary" type="submit" value="Enviar">
  </form>
  <?php
  require_once "../taller04/www/conection.php";
  use connectDB\ConnectDb as bookData;

  $dataBooks = [];

  if (isset($_GET["title"], $_GET["author"], $_GET["yearb"])) {
      $intance = bookData::getInstance();
      $dataBooks = [$_GET["title"], $_GET["author"], $_GET["yearb"]];
      $intance->setBook($dataBooks);
  }
    ?>
</body>
</html>