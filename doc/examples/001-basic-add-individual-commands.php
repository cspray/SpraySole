<?php

/* Adding individual Command implementations */

/**
 * In this example we're going to add some Commands to a \SpraySole\BasicApplication
 * one at a time using Application::addCommand.
 */

use \SpraySole\BasicApplication;

$App = new BasicApplication();

$FooCmd = new \YourApp\Command\Foo();
$BarCmd = new \YourApp\Command\Bar();
$BazCmd = new \YourApp\Command\Baz();

$App->addCommand($FooCmd);
$App->addCommand($BarCmd);
$App->addCommand($BazCmd);

// Assuming that the commands map back to 'foo', 'bar' and 'baz' you can now invoke them on the console

// You can also do this without the need for using $App each time.
// The below code is equivalent to that above

$App->addCommand($FooCmd)->addCommand($BarCmd)->addCommand($BazCmd);
