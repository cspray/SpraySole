<?php

if (\file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
} else {
    require_once __DIR__ . '/src/ClassLoader/Loader.php';

    $Loader = new \ClassLoader\Loader();
    $Loader->registerNamespaceDirectory('SpraySole', __DIR__ . '/src');
    $Loader->setAutoloader();
}

use \SpraySole\Application;

$App = new Application();


echo 'zomg nothing yet' . \PHP_EOL;
