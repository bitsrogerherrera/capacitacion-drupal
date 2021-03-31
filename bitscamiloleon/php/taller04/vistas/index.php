<?php
##conexion a la base de datos

include_once '../bd/conexion.php';
include '../logica/saveJson.php';

$db1 = Conexion::getInstance();
$db = $db1->getConnection();

/* try {
    $db = $db1->CloseConnection();
    echo "conexion cerrada";
} catch (Exception $e) {
    echo 'error';
} */


?>

<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Taller 04</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Camilo Leon</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- tabla -->
    <div class="card">
        <div class="card-body">
            <h1>Bienvenido al taller 04</h1>
            <div class="card pt-4">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Paginas</th>
                            <th scope="col">Contenido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $arrayDatos = array();
                        $sql = 'SELECT * FROM libro';
                        $count = 0;
                        if (!is_null($db)) {
                            foreach ($db->query($sql) as $item) {
                                $count++;
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td>
                                        <h2><?php echo $item['titulo']; ?></h2>
                                    </td>
                                    <td>
                                        <?php echo $item['fecha']; ?>
                                    </td>
                                    <td>
                                        <?php echo $item['autor']; ?>
                                    </td>
                                    <td>
                                        <?php echo $item['paginas']; ?>
                                    </td>
                                    <td>
                                        <div class="row">
                                        <?php
                                            $sql_contenido = 'SELECT * FROM contenido WHERE id_libro ='.$item['id'];
                                                foreach ($db->query($sql_contenido) as $chapter) {
                                            ?>
                                                <div class="col-md-3 pt-4 card">
                                                    <?php
                                                    echo 'Capitulo: '.$chapter['capitulo'];
                                                    echo '<br>';
                                                    echo 'Nombre: '.$chapter['nombre'];
                                                    echo '<br>';
                                                    echo 'Paginas: '.$chapter['paginas'];
                                                    ?>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No se realizo la conexion";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>