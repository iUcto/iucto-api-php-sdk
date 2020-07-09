<?php
date_default_timezone_set("Europe/Prague");

require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('b6230b441e5b22b23bb24ea7b40f3e7e', 'http://iucto-nginx/api');

$documentPayment = new IUcto\Command\PayDocument('2020-01-07');
$documentPayment->setAmount(100);


try {
    $payment = $iUcto->payProformaInvoiceIssued(7969, $documentPayment);
    var_dump($payment);
} catch (IUcto\ValidationException $e) {
    echo '<p>Validation errors:</p>';
    var_dump($e->getErrors());
} catch (IUcto\ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}


