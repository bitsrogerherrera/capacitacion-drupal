<?php

namespace Taller03\Product;

class Product{

	protected $name = "";
  protected $price = "";

	public function __construct($name = "", $price = ""){
		$this->name = $name;
		$this->price = $price;
	}

	public function __destruct() {
		echo '<br/><br/> Producto Eliminado.';
 	}

	public function getName(){
    return $this->name;
  }

	public function getPrice(){
    return $this->price;
  }

	public function setName($name)
  {
    $this->name = $name;
  }

	public function setPrice($price)
  {
    $this->price = $price;
  }

	public function productDescription(){
		$description = "<h1>Las caracteristicas del producto son:</h1>";
		$description .= "Name: " . $this->getName();
		$description .= "<br/> Price: " . $this->getPrice();

		return $description;
	}
}