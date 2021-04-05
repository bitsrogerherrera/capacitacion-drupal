<?php

namespace productoMain;

require_once "/home/bitsamericas/Documentos/bitsalbertorodriguez/php/taller03/interfaces/productInterface.php";

use producto;

class Product implements producto
{
    protected $title = '';
    protected $description = '';
    protected $price = '';

    public function __construct()
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $method_name = '__construct' . $number_of_arguments;
        if (method_exists($this, $method_name)) {
            call_user_func_array(
                [$this, $method_name],
                $get_arguments
            );
        } else {
            $this->title = 'undefined';
            $this->description = 'undefined';
            $this->price = 'undefined';
        }
    }

    public function __construct1($title, $description, $price)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }

    public function __destruct()
    {
        print "producto con nombre " . $this->title . "fue eliminado!";
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        return $this->title = $title;
    }

    public function getPrice()
    {
        $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function description()
    {
        return $this->title . 'Crujiente pan lleno de pasas.El precio es de:' . $this->price ;
    }
}
