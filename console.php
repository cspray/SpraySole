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
use \SpraySole\Input\ArgvInput;
use \SpraySole\Output\StreamOutput;

$App = new Application();

$Input = new ArgvInput($argv);
$StdOut = new StreamOutput('php://stdout');
$StdErr = new StreamOutput('php://stderr');

$App->run($Input, $StdOut, $StdErr);
