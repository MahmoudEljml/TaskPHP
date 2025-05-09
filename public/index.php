<?php

/**
 * Run composer autoloader
 */
include_once __DIR__ . '/../vendor/autoload.php';

// run the Framework
(new \Illuminates\Application)->start();




echo '<pre>'; 
// var_dump($router);

echo '</pre>';