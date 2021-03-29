<?php
/**
 * PHP version 7
 *
 * @category Taller03
 * @package  Taller03
 * @author   Daniel Gomez <daniel.gomez@bitsamericas.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

namespace taller03\product;

/**
 * Product class
 *
 * @category Taller03

 * @package Taller03
 *
 * @author Daniel Gomez <daniel.gomez@bitsamericas.com>
 *
 * @copyright 2021 BitsAmericas
 *
 * @license https://github.com/bitsrogerherrera/capacitacion-drupal BitsAmericas Licence
 *
 * @link None
 */

class Product
{

    protected $name = '';
    protected $price = 0;

    /**
     * Set arguments for de constructs
     */
    public function __construct()
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        $method_name = '__construct' . $number_of_arguments;
        if (method_exists($this, $method_name)) {
            call_user_func_array(
                [$this, $method_name], $get_arguments
            );
        }
    }

    /**
     * Set standar title and price for de producto
     *
     * @return void
     */
    public function __construct1()
    {
        $this->title = 'Estandar';
        $this->price = 1000;
    }

    /**
     * Set title and price for de producto
     *
     * @param string $title title of product
     * @param string $price price of product
     *
     * @return void
     */
    public function __construct2($title, $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    /**
     * Undocumented function
     */
    public function __destruct()
    {
        print "Producto " . $this->name . " eliminado";
    }

    /**
     * Set name of product
     *
     * @param string $name Nombre del producto
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name of product
     *
     * @return name pruduct
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price of product
     *
     * @param float $price Price of product
     *
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price of product
     *
     * @return name pruduct
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get description of product
     *
     * @return description pruduct
     */
    public function description()
    {
        return "Producto ". $this->name .", Precio: ".$this->price;
    }
}