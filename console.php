<?php

require_once 'vendor/autoload.php';

use \SpraySole\BasicApplication;
use \SpraySole\Input\ArgvInput;
use \SpraySole\Output\StreamOutput;
use \SpraySole\Provider\DefaultCommandProvider;

$App = new BasicApplication();

$App->registerProvider(new DefaultCommandProvider());

$Input = new ArgvInput($argv);
$StdOut = new StreamOutput(\STDOUT);
$StdErr = new StreamOutput(\STDERR);

$exitCode = (int) $App->run($Input, $StdOut, $StdErr);

exit($exitCode);
