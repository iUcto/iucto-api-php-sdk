<?php
date_default_timezone_set("Europe/Prague");

require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('your-secret-key');

try {
    $accounts = $iUcto->getBankAccounts();
    echo '<pre>';
    var_dump($accounts);
    echo '</pre>';
} catch (IUcto\ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}
