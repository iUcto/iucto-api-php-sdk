<?php
date_default_timezone_set("Europe/Prague");

require_once __DIR__ . '/../src/IUctoFactory.php';

$iUcto = IUcto\IUctoFactory::create('db684cf04efe67e97c5a4d3ceab70ed5');
try {
    $documents = $iUcto->getAllDocuments();
    echo '<pre>';
    print_r($documents);
    echo '</pre>';
} catch (IUcto\ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}
