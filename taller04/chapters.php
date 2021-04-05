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
  <a class="backTo" href="./index.php"><-Inicio</a>

  <form action="./chapters.php" method="get">
  <h3 class="text-secondary" style="margin: 20px 0;;">Capitulos del libro</h3>
    <div class="form-group">
      <label for="exampleFormControlInput1">Titulo</label>
      <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Titulo del capitulo">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Numero de hojas</label>
      <input type="text" name="numchapter" class="form-control" id="exampleFormControlInput1" placeholder="Cantidad de paginas">
    </div>
    <div class="form-group">
    <label for="exampleFormControlSelect2">Libro</label>
    <select name="idlibro" class="form-control" id="exampleFormControlSelect2">
      <?php
      require_once "../taller04/www/conection.php";
      use connectDB\ConnectDb as bookData;
      $intance = bookData::getInstance();
      foreach ($intance->getBooks() as $key => $value) {
          echo '<option value=' . $value['id'] . '>' . $value['title'] . '</option>';
      }
      ?>
    </select>
  </div>
    <input class="btn btn-primary" type="submit" value="Enviar">
  </form>
  <?php
    $dataBooks = [];
    if (isset($_GET["title"], $_GET["numchapter"], $_GET["idlibro"])) {
        $dataBooks = [$_GET["title"], $_GET["numchapter"], $_GET["idlibro"]];
        $intance->setChapters($dataBooks);
    }
    ?>
</body>
</html>