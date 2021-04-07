<?php

require_once("libro.php");

//crear clase
class Prueba extends Libro
{

    protected $libro = [];

    public function __construct($Nombre = "", $Precio = "")
    {
        $this->Nombre = $Nombre;
        $this->Precio = $Precio;
    }


    //leer capitulos
    public function leer($capitulos)
    {
        $capitulo = array_rand($capitulos, 3);
        $res = "CAPITULOS";
        $res .= $capitulo[0] . "</br>";
        $res .= $capitulo[1] . "</br>";
        $res .= $capitulo[2] . "</br>";
        return $res;
    }
}

//imprime la informacion agregada en el archivo.json
$data = file_get_contents("archivo.json");
$products = json_decode($data, true);

foreach ($products as $product) {
    echo '<pre>';
    print_r($product);
    echo '</pre>';
}

//imprimir informacion
$info = new Prueba();
$libro = $read->archivo();
foreach ($productos as $libro) {
    $info->setAutor($libro["autor"]);
    $info->setAño($libro["año"]);
    $info->getPaginas();
    $info->$Descripcion();
    if (isset($libro["capitulos"])) {
        foreach ($libro["capitulos"] as $capitulos => $pagina) {
            $info->addCapitulo($capitulo, $paginas);
        }
        echo $info->leer($libro["capitulos"]);
        $info->getCapitulos();
    }
}
