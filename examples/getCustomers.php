<?php
date_default_timezone_set("Europe/Prague");

require_once __DIR__ . '/../src/IUctoFactory.php';

$iUcto = IUcto\IUctoFactory::create('62b905ecb3e0ec6e760f20aacc59f15c'); // přidejte druhý parametr "http://gsmobile-novydesign.dev2.datesoft.cz/api" pro volání testovací verze


try {
    $customers = $iUcto->getCustomers();
    echo '<pre>';
    var_dump($customers);
    echo '</pre>';
} catch (IUcto\ConnectionException $e) {
    // network layer problem
    // HTTP response code
    echo $e->getCode();
    // Message from the server
    echo $e->getMessage();
}

