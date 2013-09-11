# SpraySole

[![Build Status](https://travis-ci.org/cspray/SpraySole.png?branch=master)](https://travis-ci.org/cspray/SpraySole) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/cspray/SpraySole/badges/quality-score.png?s=96e48ad7d84b5f6a8cfc878241a70abf9b8e6fdf)](https://scrutinizer-ci.com/g/cspray/SpraySole/) [![Code Coverage](https://scrutinizer-ci.com/g/cspray/SpraySole/badges/coverage.png?s=003dc2b01002006cb80444d60ecf0ba1a8acbea8)](https://scrutinizer-ci.com/g/cspray/SpraySole/)

SpraySole is a PHP library to help create console applications powered by PHP. The API is intended to allow the easy creation of console applications that can be object oriented and cleanly separated.

## Project Goals

- Support the easy creation of console apps powered by PHP following the common use case of: `[options] command [arguments]`
- Provide implementations that support the debugging, profiling and analysis of SpraySole driven apps
- Completely self-contained and should not require any third-party userland libraries that are not bundled with the source
- Build all components using [SOLID][solid], readable and thoroughly unit-tested code

## Installation

The recommended method for installing SpraySole is through Composer. We're going to assume that you already have Composer installed on your machine and that you can execute it from the command line by typing, you guessed it, `composer`.

```shell
composer require cspray/spraysole:0.1.*
```

This will install the SpraySole library for you in your current working directory.

If you already have a project you'd like to use SpraySole in you can also adjust your `composer.json`.

```json
{
    "require": {
        "cspray/spraysole": "0.1.*"
    }
}
```

## Usage

This is the basic example for kicking off processing and similar to what you'll
find in /console.php.

```php
<?php

use \SpraySole\BasicApplication;
use \SpraySole\Input\ArgvInput;
use \SpraySole\Output\StreamOutput;

$App = new BasicApplication();

$App->addCommand(new \YourApp\Command\DooHickey());
$App->registerProvider(new \YourApp\Command\FooProvider());

$Input = new ArgvInput($argv);
$StdOut = new StreamOutput(\STDOUT);
$StdErr = new StreamOutput(\STDERR);

// $StdErr is optional and will use $StdOut if not provided
$exitCode = $App->run($Input, $StdOut, $StdErr);

exit($exitCode);

?>
```

Now, in your console you can execute your app and the commands associated to it. In the example below we'll assume that you have aliased `spraysole` to execute `/install/console.php` with PHP.

```
spraysole --foo bar --bar baz commandname arg1 arg2 arg3
```

[solid]: http://en.wikipedia.org/wiki/SOLID_(object-oriented_design) "S.O.L.I.D."
[spraysoledownload]: https://github.com/cspray/SpraySole/archive/master.zip "SpraySole Download"

