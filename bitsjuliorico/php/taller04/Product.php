<?php

namespace taller04\Product;

use taller04\ProductInterface\ProductInterface;

require("interfaceProduct.php");

class Product implements ProductInterface
{
  protected $name, $price;

  public function __construct($name = null, $price = null)
  {
    $number_of_arguments = func_num_args();
    $get_arguments       = func_get_args();
    $message = "\n constructor with $number_of_arguments parameter";
    foreach ($get_arguments as $value) {
      $message .= " $value";
    }
    print $message;

  }
  public function __destruct()
  {
    print "Producto $this->name eliminado";
  }
  public function getName()
  {
    return $this->name;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getPrice()
  {
    return $this->price;
  }
  public function setPrice($price)
  {
    $this->price = $price;
  }
  public function description()
  {
    return "$this->name $this->price";
  }
}

