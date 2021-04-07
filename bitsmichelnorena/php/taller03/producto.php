<?php

//clase
class Producto

{
    //Atributos protected accesibles en clases que hereden de esta
    protected $Nombre = "";
    protected $Precio = "";

    /*constructor se encargan de resumir las acciones de inicialización
    de los objetossiempre tiene que ser publico*/
    public function __construct($Nombre = "", $Precio = "")
    {
        $this->Precio = $Precio;
        $this->Nombre = $Nombre;
    }

    /*destructor se encargan de realizar las tareas que se necesita ejecutar
    cuando un objeto deja de existir*/
    public function __destruct()
    {
        echo "<br>" . "El libro: " . $this->Nombre . ", ha sido eliminado ";;
    }

    //getters método de acceso, solo devolverá el valor del atributo.
    public function getNombre(): string
    {
        return $this->Nombre;
    }
    public function getPrecio(): string
    {
        return $this->Precio;
    }

    //setterrs método modificador, asignara un nuevo valor al atributo.
    public function setNombre(string $Nombre)
    {
        return $this->Nombre;
    }
    public function setprecio(string $Precio)
    {
        return $this->Precio;
    }

    //descripcion
    public function DescripcionLibro()
    {
        $Descripcion = "las caracteristicas del libro son:<br> Nombre:"
            . $this->Nombre . "<br> Precio:" . $this->Precio;

        echo $Descripcion;
    }
}

$producto1 = new Producto("Los cien años de Lenni y Margot", 100);
$producto1->DescripcionLibro();


