<?php
namespace nitish;
class Product {

    /**
     *
     * @var type 
     */
    private $price;

    /**
     *
     * @var type 
     */
    private $name;
    
    public function __construct() {
        
    }

    /**
     * 
     * @return type
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * 
     * @param type $price
     * @return $this
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @param type $name
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

}
