<?php

namespace insertJSON;
require_once 'main.php';
require_once 'www/conection.php';
use indexMain\Index as readBooks;
use connectDB\ConnectDb as conexion;

class InsertJSON
{
    public function __construct()
    {
        $instance = new readBooks();
        $newConexion = conexion::getInstance();

        foreach ($instance->newArrayBook as $key => $value) {
            $data = [$value->getTitle(), $value->getAutor(), $value->getYear()];
            print_r($data);
            $newConexion-> setBookIterative($data);
            if (count($value->getIndex()) > 0) {
                foreach ($value->getIndex() as $key => $chapters) {
                    print($value->getTitle());
                    $idBook = $newConexion-> searchBook($value->getTitle());
                    if ($idBook) {
                        print_r($chapters[0]);
                        $chapterCap = [$chapters[0], $chapters[1],  $idBook];
                        $newConexion->setChapters($chapterCap);
                    }
                }
            }
        }
    }
}

$intance = new InsertJSON();
