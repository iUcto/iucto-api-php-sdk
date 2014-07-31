<?php
$filename = __DIR__ . '/../examples/'. $_GET['name'].'.php';
if (file_exists($filename)) {
    echo file_get_contents($filename);
//    echo str_replace("\n", "<br>", file_get_contents($filename));
}
