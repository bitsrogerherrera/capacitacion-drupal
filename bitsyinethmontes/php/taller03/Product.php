<?php
/**
* - Definir namespace
* - Crear contructor con y sin parametros
* - Crear destructor que imprima un mensaje indicando que se elimino el producto
* - Crear las propiedades protegidas name, price con getters y seetterrs
* - Crear metodo description que retorne un string con las caracteristica del producto.
 */
namespace php\taller03\Product;
error_reporting(E_ALL);


interface ProductsInterface
{
  public function description();
}

class Product implements ProductsInterface
{
  protected $name;
  protected $price;
  
  function __construct1() 
  {
    print "El constructor";
  }

  public function __construct($name=null,$price=null) 
  {
    if(isset($name))
    {
      $this->name   = $name;
    }

    if(isset($price))
    {
      $this->price  = $price;
    }
  }


  public function setName($name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setPrice($price)
  {
    $this->price = $price;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function description()
  {
    $name = $this->getName();
    $price = $this->getPrice();
    return "Producto : ".$name."  <br>  Precio : ".$price." <br> ";
  }

  public function __destruct() 
  {
    print "Se eliminó el producto";
  }

}

?>