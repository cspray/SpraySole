<?php

require_once 'vendor/autoload.php';

use \SpraySole\BasicApplication;
use \SpraySole\Input\ArgvInput;
use \SpraySole\Output\StreamOutput;
use \SpraySole\Provider\DefaultCommandProvider;

$App = new BasicApplication();

$App->registerProvider(new DefaultCommandProvider());

$Input = new ArgvInput($argv);
$StdOut = new StreamOutput('php://stdout');
$StdErr = new StreamOutput('php://stderr');

$exitCode = (int) $App->run($Input, $StdOut, $StdErr);

exit($exitCode);
