<?php

require_once __DIR__ . '/../IUctoFactory.php';

$iUcto = IUctoFactory::create('db684cf04efe67e97c5a4d3ceab70ed5');
try {
$documents = $iUcto->createNewDocument();

var_dump($documents);

} catch (ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}

array(
    "variable_symbol" => "20140001",
    "date" => 1402557951,
    "date_vat" => 1402557951,
    "maturity_date" => 1402557951,
    "currency" => "CZK",
    "customer_id" => 5779,
    "customer_bank_account" => null,
    "payment_type" => "transfer",
    "bank_account" => 825,
    "date_vat_prev" => null,
    "description" => null,
    "rounding_type" => null,
    "items" => array(
        array(
            "text" => "b\u00edl\u00e9 tri\u010dko",
            "amount" => 5,
            "price" => 400,
            "unit" => "ks",
            "vat" => 21,
            "accountentrytype_id" => 16,
            "vattype_id" => 1,
            "department_id" => 0,
            "contract_id" => 0,
            "chart_account_id" => 309,
            "vat_chart_id" => 302), array(
            "text" => "doprava",
            "amount" => 1,
            "price" => 85,
            "unit" => null,
            "vat" => 21,
            "accountentrytype_id" => 63,
            "vattype_id" => 23,
            "department_id" => 0,
            "contract_id" => 0,
            "chart_account_id" => 272,
            "vat_chart_id" => 302)));
