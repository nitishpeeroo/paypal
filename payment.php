<?php

use nitish\Basket;

use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

require 'vendor/autoload.php';
require 'src/Basket.php';
require 'src/Product.php';
require 'src/TransactionFactory.php';
$ids = require 'paypal.php';


$apiContext = new ApiContext(
        new OAuthTokenCredential(
        $ids['id'], $ids['secret']
        ));
$basket = Basket::fake();


$redirect_urls = (new RedirectUrls())
        ->setReturnUrl('http://localhost:8000/pay.php')
        ->setCancelUrl('http://localhost:8000/index.php');

$payment = new Payment();
$payment->addTransaction(TransactionFactory::fromBasket($basket,0.2));
$payment->setIntent('sale');
$payment->setRedirectUrls($redirect_urls);
$payment->setPayer((new Payer())->setPaymentMethod('paypal'));

try {
    $payment->create($apiContext);
   // header('Location: '.$payment->getApprovalLink());
    echo json_encode([
        'id' => $payment->getId()
    ]);
} catch (PayPalConnectionException $e) {
    var_dump(json_decode($e->getData()));
}


