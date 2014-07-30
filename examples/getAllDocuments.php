<?php
require_once __DIR__ . '/../IUctoFactory.php';

$iUcto = IUctoFactory::create('db684cf04efe67e97c5a4d3ceab70ed5', 'http://api.gsmobile-novydesign.dev2.datesoft.cz/');
$documents = $iUcto->getAllDocuments();

var_dump($documents);
