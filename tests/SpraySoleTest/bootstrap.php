<?php

defined('SPRAYSOLE_ROOT') or define('SPRAYSOLE_ROOT', \dirname(\dirname(__DIR__)));

include \SPRAYSOLE_ROOT . '/src/ClassLoader/Loader.php';

$Loader = new \ClassLoader\Loader();
$Loader->registerNamespaceDirectory('SpraySole', \SPRAYSOLE_ROOT . '/src');
$Loader->registerNamespaceDirectory('SpraySoleTest', \SPRAYSOLE_ROOT . '/tests');
$Loader->setAutoloader();
