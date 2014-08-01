<?php

require_once __DIR__ . '/../IUctoFactory.php';

$iUcto = IUctoFactory::create('db684cf04efe67e97c5a4d3ceab70ed5', 'http://api.gsmobile-novydesign.dev2.datesoft.cz/');

$data = array(
    "name" => "Jan Novák",
    "name_display" => null,
    "comid" => "1234568004",
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
        "postalcode" => "385 02",
        "country" => "CZ"),
    "note" => null,
    "account_number1" => "1230123/0100",
    "account_number2" => null,
    "account_number3" => null,
    "account_number4" => null
);

try {
    $documents = $iUcto->createCustomer($data);
    var_dump($documents);
} catch (ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}