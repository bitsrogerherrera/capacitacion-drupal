<?php
/**
 * Clase Producto
 */
namespace Php\Product;

/**
 * Interface IProduct
 *
 * @package Php\Product
 */
interface IProduct
{
    /**
     * Se define funcion
     *
     * @return mixed
     */
    public function description();
}

/**
 * Class Product
 *
 * @package Php\Product
 */
class Product implements IProduct
{

    protected string $name;
    protected int $price;

    /**
     * Product constructor.
     */
    public function __construct($name, $price)
    {
        $this -> name = $name;
        $this -> price = $price;
    }

    /**
     * Desctructor
     */
    public function __destruct()
    {
        print "<br>" . "El libro: " . $this->name . ", ha sido eliminado ";
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this -> name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this -> name = $name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this -> price;
    }

    /**
     * @param $price
     */
    public function setPrice($price)
    {
        $this -> price = $price;
    }

    /**
     * @return mixed|void
     */
    public function description()
    {
        print "Book Name: "
            . $this->getName() . "<br>"
            . "Price: " . $this->getPrice()
            . "<br>";
    }
}

$product1 = new Product("Narraciones Extraordinarias", 200);
$product1 -> description();
