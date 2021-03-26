<?php

/* Definir namespace */
namespace Taller03\Product;

/* Interface */
interface interProduct {
  public function setName($name);
  public function setPrice($price);
  public function description();
}

class Product implements interProduct {

  /* Propiedades */
  protected $name;
  protected $price;

  /* Definir constructor */
  public function __construct($name = '', $price= '') {
    $this->name = $name;
    $this->price = $price;
  }

  /* Definir destructor */
  public function __destruct() {
    echo '<div style="text-align: center; margin-top: 25%"><small>Se eliminó el producto: '. $this->name . '.</small></div>';
  }

  /* Métodos */
  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getPrice() {
    return $this->price;
  }

  public function setPrice($price) {
    $this->price = $price;
  }

  public function description() {
    $description = '<li><span style="font-weight: bold">' . $this->name . "</span> (".$this->price.")</li>";
    echo $description;
  }
}
?>