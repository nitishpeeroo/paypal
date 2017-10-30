<?php

use nitish\Basket;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
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

$payment = Payment::get($_POST['paymentID'], $apiContext);
//$payment->getPayer()->getPayerInfo()->getCountryCode();
$execution = (new PaymentExecution())
        ->setPayerId($_POST['payerID'])
        ->addTransaction(TransactionFactory::fromBasket($basket, 0.2));
try {
    $payment->execute($execution, $apiContext);
    $custom = $payment->getTransactions()[0]->getCustom();
    echo json_encode([
        'id' => $payment->getId()
    ]);
} catch (PayPalConnectionException $e) {
    header('HTTP 500 Internal Server Error', true, 500);
    var_dump(json_decode($e->getData()));
}