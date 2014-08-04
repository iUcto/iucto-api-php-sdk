<?php
date_default_timezone_set("Europe/Prague");

require_once __DIR__ . '/../IUctoFactory.php';

$iUcto = IUcto\IUctoFactory::create('db684cf04efe67e97c5a4d3ceab70ed5');

$updatedDocument = new IUcto\Command\SaveDocument(
            array(
        "variable_symbol" => "20130001",
        "date" => 1375620595,
        "date_vat" => 1375620595,
        "maturity_date" => 1375620595,
        "currency" => "CZK",
        "customer_id" => 1638,
        "customer_bank_account" => null,
        "payment_type" => "transfer",
        "bank_account" => 275,
        "date_vat_prev" => null,
        "description" => null,
        "rounding_type" => "none",
        "items" => array(
            array(
                "text" => "Bílé tričko",
                "amount" => 5,
                "price" => 400,
                "unit" => "ks",
                "vat" => 21,
                "accountentrytype_id" => 82,
                "vattype_id" => 3,
                "department_id" => 0,
                "contract_id" => 0,
                "chart_account_id" => 309,
                "vat_chart_id" => 302), 
            array(
                "text" => "doprava",
                "amount" => 1,
                "price" => 85,
                "unit" => null,
                "vat" => 21,
                "accountentrytype_id" => 82,
                "vattype_id" => 3,
                "department_id" => 0,
                "contract_id" => 0,
                "chart_account_id" => 272,
                "vat_chart_id" => 302)
        )
            )
    );

try {
    $documents = $iUcto->updateDocument(2642, $updatedDocument);
    var_dump($documents);
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


