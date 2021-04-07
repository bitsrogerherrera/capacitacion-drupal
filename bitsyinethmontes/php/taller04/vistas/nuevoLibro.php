<?php

require_once('../clases/Jobs.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<div style='align-content: center;margin-left: 39%;margin-top: 6%;background-color: darkgrey;width: 459px;padding-left: 5%;padding-top: 2%;padding-bottom: 2%;'>";
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) 
    {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('txt');
        if (in_array($fileExtension, $allowedfileExtensions)) 
        {
            $info = $jobs->getInfoUploadFile($fileTmpPath);
            $save = $jobs->storeBookBD($info);
            if(empty($save['error']))
            {
                echo "Exitoso! <br>";
                echo $save['mensajes'];
            }
            else
            {
                echo "Error! <br>";
                echo $save['error'];
            }
        }
        else
        {
            echo "Lo sentimos debe cargar un archivo .txt";
        }
    }
    else
    {
        // Cargar el archivo estatico
        echo "No se anexó archivo";
    }
    echo "<a href='../index.php'><button style='color: #fff;background-color: #007bff;border-color: #007bff;'>Regresar</button></a>";
echo "</div>";
?>