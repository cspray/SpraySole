<?php

require_once 'vendor/autoload.php';

use \SpraySole\Application;
use \SpraySole\Input\ArgvInput;
use \SpraySole\Output\StreamOutput;

$App = new Application();

$Input = new ArgvInput($argv);
$StdOut = new StreamOutput('php://stdout');
$StdErr = new StreamOutput('php://stderr');

$exitCode = (int) $App->run($Input, $StdOut, $StdErr);

exit($exitCode);
