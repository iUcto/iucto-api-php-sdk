<?php
date_default_timezone_set("Europe/Prague");

require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('your-secret-key');
try {
    $newDocument = new IUcto\Command\SaveDirectExpense(
        array(
            "external_code" => "20140001",
            "variable_symbol" => "20140001",
            "date" => "2024-06-01",
            "date_vat" => "2024-06-01",
            "maturity_date" => "2024-06-30",
            "currency" => "CZK",
            "supplier_id" => 101000000,
            "payment_type" => "transfer",
            "bank_account" => 101000000,
            "date_vat_prev" => null,
            "description" => null,
            "rounding_type" => "none",
            "chartaccount_dal_id" => 306,
            "items" => array(
                array(
                    "text" => "Bílé tričko (lze prát na 60 °C)",
                    "amount" => 5,
                    "price" => 400,
                    "unit" => "ks",
                    "vat" => 0,
                    "accountentrytype_id" => 17,
                    "vattype_id" => 3,
                    "department_id" => 0,
                    "contract_id" => 0,
                    "chart_account_id" => 284,
                    "vat_chart_id" => 281),
                array(
                    "text" => "doprava",
                    "amount" => 1,
                    "price" => 85,
                    "unit" => null,
                    "vat" => 0,
                    "accountentrytype_id" => 17,
                    "vattype_id" => 3,
                    "department_id" => 0,
                    "contract_id" => 0,
                    "chart_account_id" => 284,
                    "vat_chart_id" => 281)
            )
        )
    );

    $document = $iUcto->createDirectExpense($newDocument);

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


