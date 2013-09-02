<?php

require_once 'vendor/autoload.php';

use \SpraySole\BasicApplication;
use \SpraySole\Input\ArgvInput;
use \SpraySole\Output\StreamOutput;
use \SpraySole\Provider\DefaultCommandProvider;

$App = new BasicApplication();

$App->registerProvider(new DefaultCommandProvider());

$exitCode = (int) $App->run(new ArgvInput($argv), new StreamOutput(\STDOUT), new StreamOutput(\STDERR));
exit($exitCode);
