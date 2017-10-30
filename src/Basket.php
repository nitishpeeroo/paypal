<?php

namespace nitish;
class Basket {

    /**
     *
     * @var type 
     */
    private $products;

    /**
     * 
     * @return mixed
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * 
     * @param mixed $products
     * @return Basket
     */
    public function setProducts($products) {
        $this->products = $products;
        return $this;
    }

    /**
     * 
     * @param \nitish\Product $product
     * @return $this
     */
    public function addProduct(Product $product) {
        $this->products[] = $product;
        return $this;
    }

    /**
     * 
     * @return float
     */
    public function getPrice(): float {
        return array_reduce($this->getProducts(), function($total, Product $product) {
            return $product->getPrice() + $total;
        }, 0);
    }

    public function getVatPrice($rate): float {
        return round($this->getPrice() * $rate * 100) / 100;
    }

    /**
     * 
     * @return type
     */
    public static function fake() {
        $products = array_map(function($price) {
            return (new Product())
                    ->setPrice($price)
                    ->setName('Produit qui coute ' . $price."€");
        }, [1.21, 10.22, 40.00]);
        return (new self())->setProducts($products);
    }

}
