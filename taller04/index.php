<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/estilos.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <title>Document</title>
</head>
<body>
<!-- <form action="index.php" method="get">
  <label for="option">Ingrese el metodo a utilizar: </label></br>
  <select name="option" id="">
    <option value="0">Getters</option>
    <option value="1">Constructor</option>
  </select>
  </br>
  <input type="submit" value="Enviar">
</form> -->

<header>
            <div class="alert alert-info">
            <h3>Capacitacion Drupal</h3>
            </div>
        </header>

        <section>
            <a  class="btn btn-primary" style="margin: 12px 0;" href="createBook.php">Crear Registro</a>
            <a  class="btn btn-warning" style="margin: 12px 0;" href="insertJson.php">Cargar Json</a>
            <table class="col-md-12 mx-5 bg-white">
                <tr class="bg-primary">
                    <th class="pad-basic">Title</th>
                    <th class="pad-basic">Author </th>
                    <th class="pad-basic">Nombre Capitulo </th>
                    <th class="pad-basic">Cant Hojas </th>
                <tr>
            <?php
            require_once "../taller04/www/conection.php";
            use connectDB\ConnectDb as bookData;

            $data = bookData::getInstance();
            foreach ($data->getBooksJoinChapters() as $key => $value) {
                echo'
              <tr>
              <td>' . $value['title'] . '</td>
              <td>' . $value['author'] . '</td>
              <td>' . $value['titlechapter'] . '</td>
              <td>' . $value['numchapter'] . '</td>
              </tr>
              ';
            }
            ?>
            </table>
          </section>
</body>
</html>
