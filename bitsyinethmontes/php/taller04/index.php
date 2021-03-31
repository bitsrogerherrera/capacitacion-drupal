

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Taller4</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">BITS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container">
        <hr>
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col">
                    <div class="p-3 border bg-light">
                        <div class="card" style="width: 100%;">
                            <img src="https://estaticos.muyinteresante.es/media/cache/1000x_thumb/uploads/images/test/5899d3b75cafe85ef18b4568/test-libros1.jpg" class="card-img-top" alt="Libros" width="100%" height="243px">
                            <div class="card-body">
                                <h5 class="card-title">Agregar Libros</h5>
                                <p class="card-text"> Para Adicionar Libros necesitará un archivo .txt , con la siguiente estructura : </p>
                                <blockquote>
                                    [ {
                                        <p>"name": "Libro 1",</p>
                                        <p>"price" : "20000",</p>
                                        <p>"author" : "Autor 1",</p>
                                        <p>"year" : "2020",</p>
                                        <p>"sheets" : "1200",</p>
                                        <p>"index" : ["capitulo1","capitulo2"]</p>
                                        <p>}, </p>
                                        <p>{ ... }</p>
                                    ]
                                </blockquote>
                                <form method="POST" action="vistas/nuevoLibro.php" enctype="multipart/form-data">
                                    <div>
                                        <span>Archivo a cargar:</span>
                                        <input class="form-control" type="file" name="uploadedFile" />
                                    </div>
                                    <hr>
                                    <input class="btn btn-primary" type="submit" name="uploadBtn" value="Cargar Archivo" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light">
                        <div class="card" style="width: 100%;">
                            <img src="https://estaticos.muyinteresante.es/media/cache/1000x_thumb/uploads/images/test/5899d3b75cafe85ef18b4568/test-libros1.jpg" class="card-img-top" alt="Libros" width="100%" height="243px">
                            <div class="card-body">
                                <h5 class="card-title">Verificar Libros</h5>
                                <p class="card-text">En esta opción podrá visualizar so libros que estan registrados </p>
                                
                                <a href="vistas/listarLibros.php"><input class="btn btn-primary" type="submit" name="uploadBtn" value="Ver Libros" /></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>