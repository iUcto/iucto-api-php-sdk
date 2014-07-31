<?php

require_once __DIR__ . '/../IUctoFactory.php';

$iUcto = IUctoFactory::create('db684cf04efe67e97c5a4d3ceab70ed', 'http://api.gsmobile-novydesign.dev2.datesoft.cz/');
try {
    $documents = $iUcto->getAllDocuments();
    var_dump($documents);
} catch (ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}
