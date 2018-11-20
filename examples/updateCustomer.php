<?php
date_default_timezone_set("Europe/Prague");

require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('your-secret-key');

$data = array(
    "name" => "Jan Novák",
    "name_display" => null,
    "comid" => "1234568002",
    "vatid" => null,
    "vat_payer" => false,
    "email" =>
        "novak.jan@iucto.cz",
    "phone" => null,
    "cellphone" => null,
    "www" => null,
    "usual_maturity" => 30,
    "preferred_payment_method" => "transfer",
    "invoice_language" => "cs",
    "address" => array(
        "street" => "Stodolní 123",
        "city" => "Ostrava",
        "postalcode" => "385 03",
        "country" => "CZ"),
    "note" => null,
    "account_number1" => "1230123/0100",
    "account_number2" => null,
    "account_number3" => null,
    "account_number4" => null
);

try {
    $customer = $iUcto->updateCustomer(8875, new IUcto\Command\SaveCustomer($data));
    echo '<pre>';
    print_r($customer);
    echo '</pre>';
} catch (IUcto\ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}

