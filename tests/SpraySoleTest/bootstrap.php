<?php

defined('SPRAYSOLE_ROOT') or define('SPRAYSOLE_ROOT', \dirname(\dirname(__DIR__)));

/** @var \Composer\Autoload\ClassLoader $Loader */
$Loader = require_once \dirname(\dirname(__DIR__)) . '/vendor/autoload.php';
$Loader->set('SpraySoleTest', \SPRAYSOLE_ROOT . '/tests');
