<?php
date_default_timezone_set("Europe/Prague");

require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('your-secret-key');
try {
    $newDocument = new IUcto\Command\SaveInvoiceIssued(
        array(
            "variable_symbol" => "20140001",
            "date" => "2014-06-01",
            "date_vat" => "2014-06-01",
            "maturity_date" => "2014-06-30",
            "currency" => "CZK",
            "customer_id" => 1638,
            "payment_type" => "transfer",
            "bank_account" => 275,
            "date_vat_prev" => null,
            "description" => null,
            "rounding_type" => "none",
            "items" => array(
                array(
                    "text" => "Bílé tričko (lze prát na 60 °C)",
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

    $document = $iUcto->createInvoiceIssued($newDocument);

    echo '<pre>';
    print_r($document);
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


