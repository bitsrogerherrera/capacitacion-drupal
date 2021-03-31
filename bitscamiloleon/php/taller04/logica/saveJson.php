<?php

include_once '../bd/conexion.php';
$db1 = Conexion::getInstance();
$db = $db1->getConnection();

/* try {
    $db = $db1->CloseConnection();
    echo "conexion cerrada";
} catch (Exception $e) {
    echo 'error';
} */
/* guardado automatico de json */
$books = file_get_contents("../json/books.json");
$books = json_decode($books);
$count = 0;
$Arraybooks = [];
foreach ($books as $item) {
    $count++;

    $data = array(
        'libro'=>$count,
        'Titulo'=>$item->Titulo,
        'Autor'=>$item->Autor,
        'Año'=>$item->Año,
        'Paginas'=>$item->Paginas,
        'Contenido'=>$item->Contenido
    );
    array_push($Arraybooks,$data);
}

/* insercion */
$bandera = true;
$bandera_cont = true;
foreach ($Arraybooks as $key => $value) {
    $t=$value['Titulo'];
    $a=$value['Autor'];
    $y=$value['Año'];
    $p=$value['Paginas'];

    $sql = "INSERT INTO libro (titulo,autor,fecha,paginas) VALUES ('$t','$a','$y',$p)";

    if(!$db->query($sql)){
        $bandera = false;
    }
    /* busqueda del ultimo registro */
    $sql = "SELECT MAX(id) as id FROM libro";

    $lastID = 0;

    foreach ($db->query($sql) as $item) {$lastID = $item['id'];}

    /* guardado de contenido de cada libro */
    foreach ($value['Contenido'] as $index) {
        $Cc=$index->Capitulo;
        $Cn=$index->Nombre_Capitulo;
        $Cp=$index->paginas;
        $CID=$lastID;

        $sql = "INSERT INTO contenido (capitulo,nombre,paginas,id_libro) VALUES ($Cc,'$Cn',$Cp,$CID)";
        if(!$db->query($sql)){
            $bandera_cont = false;
        }
    }
}

if($bandera){
    echo '<h4>Registros exitosos en base de datos</h4>';
}else{
    echo '<h4>Registros No exitoso, no se creo todos los registros en la base de datos</h4>';
}

if($bandera_cont){
    echo '<h4>Registros de contenido exitosos en base de datos</h4>';
}else{
    echo '<h4>Registros de contenido No exitoso, no se creo todos los registros en la base de datos</h4>';
}