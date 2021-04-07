<?php

namespace App\Product;

require('ProductInterface.php');

class Product implements ProductInterface
{
    protected $name;
    protected $price;

    public function __construct($name = null, $price = null)
    {
        if (isset($name)) {
            $this->name = $name;
        }
        if (isset($price)) {
            $this->price = $price;
        }
    }

    public function __destruct()
    {
        print('Destroying product\n');
    }

    public function getName()
    {
        return htmlentities($this->name);
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
        printf("The product name is %s and their price is %d", $this->name, $this->price);
    }
}
