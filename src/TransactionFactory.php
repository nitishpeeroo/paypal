<?php
use nitish\Basket;
use PayPal\Api\Transaction;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;

class TransactionFactory {

    public static function fromBasket(Basket $basket, float $rate = 0): Transaction {
       
        /**
         * Creation de liste de produit
         */
        $list = new ItemList();
        foreach ($basket->getProducts() as $product) {
            $item = (new Item())
                    ->setName($product->getName())
                    ->setPrice($product->getPrice())
                    ->setCurrency('EUR')
                    ->setQuantity(1);
            $list->addItem($item);
        }
        /**
         * Prix totalet sous total
         */
        $details = (new Details())
                ->setTax($basket->getVatPrice($rate))
                ->setSubtotal($basket->getPrice());

        $amount = (new Amount())
                ->setTotal($basket->getPrice() + $basket->getVatPrice($rate))
                ->setCurrency('EUR')
                ->setDetails($details);

        return (new Transaction())
                        ->setItemList($list)
                        ->setDescription("Achat sur ma boutique")
                        ->setAmount($amount)
                        ->setCustom('demo-1');
    }

}
