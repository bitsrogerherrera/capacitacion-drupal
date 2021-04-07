<?php

require_once("producto.php");

class Libro extends Producto

{
    //Atributos protected accesibles en clases que hereden de esta
    protected $Indice = [];
    protected $Paginas = [];
    protected $Autor = "";
    protected $Año = "";

    /*constructor se encargan de resumir las acciones de inicialización
    de los objetos siempre tiene que ser publico*/
    public function __construct($Indice = "", $Paginas = "", $Autor = "", $Año = "")
    {
        $this->Inicio = $Indice;
        $this->Paginas = $Paginas;
        $this->Autor = $Autor;
        $this->Año = $Año;
    }

    /*destructor se encargan de realizar las tareas que se necesita ejecutar
    cuando un objeto deja de existir*/
    public function __destruct()
    {
        echo "<br>del autor " . $this->getAutor();
    }

    //getters método de acceso, solo devolverá el valor del atributo.
    public function getIndice()
    {
        return $this->Indice;
    }
    public function getPaginas(): string
    {
        return $this->Paginas;
    }
    public function getAutor(): string
    {
        return $this->Autor;
    }
    public function getAño(): string
    {
        return $this->Año;
    }

    //setterrs método modificador, asignara un nuevo valor al atributo.
    public function setIndice()
    {
        return $this->Indice;
    }
    public function setPaginas(): string
    {
        return $this->Paginas;
    }
    public function setAutor(string $Autor)
    {
        return $this->Autor;
    }
    public function setAño(string $Año)
    {
        return $this->Año;
    }

    //descripcion
    public function DescripcionLibro()
    {
        $Descripcion = "<br>Autor:" . $this->Autor . "<br> Año:" . $this->Año  . "<br>";

        echo $Descripcion;
    }

    //agregar capitulo
    public function addCapitulo($NombreCapitulo, $NumeroHojas)
    {
        $Descrip = array_push($this->Indice, $NombreCapitulo);
        $Descrip = array_push($this->Pagina, $NumeroHojas);

        return $Descrip;
    }

    //numero de capitulos
    public function getCapitulos()
    {
        for ($i = 0; $i < count($this->Indice); $i++) {
            $i;
        }

        echo "Numero de Capitulos: " . $i  . "<br>";
    }

    //nombre capitulo
    public function getNombreCapitulo($NombreCapitulo)
    {
        foreach ($this->Indice as $key => $value) {
            if ($key == $NombreCapitulo) {
                echo "<b>" . $value . "</b>" . " seleccionado" . "</br>";
            }
        }
    }

    //promedio
    public function PromedioHojasCapitulo()
    {
        $TotalCapitulos = $this->Indice;
        $sum = 0;

        if (!$TotalCapitulos) {
            echo 0 . "<br>";
        } else {
            foreach ($TotalCapitulos as $valor) {
                $sum = $sum + $valor['NumeroCapitulos'];
            }
        }
        $average = $sum / count($TotalCapitulos);
        echo "Promedio de hojas por capitulo:" . (int)$average;
    }
}

$libro1 = new Libro("Los cien años de Lenni y Margot", 5, "Marianne Cronin", 2021);
$libro1->DescripcionLibro();
$libro1->addCapitulo("capitulo 1", 39);
$libro1->getCapitulos();
$libro1->getNombreCapitulo(2);
$libro1->PromedioHojasCapitulo();