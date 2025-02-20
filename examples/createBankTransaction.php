<?php
date_default_timezone_set("Europe/Prague");

require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('your-secret-key');

$data = array(
    "payment_type" => "in",
    "price" => 100,
    "currency" => "CZK",
    "date_payment" => "2024-09-04",
    "bank_account" => 101000000,
    "amount_original" => 200,
    "currency_original" => "USD",
);

try {
    $transaction = $iUcto->createBankTransaction(new \IUcto\Command\SaveBankTransaction($data));
    echo '<pre>';
    print_r($transaction);
    echo '</pre>';
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
