# SpraySole

SpraySole is a PHP library to help create console applications powered by PHP. The API is intended to allow the easy creation of console applications that can be object oriented and cleanly separated.

**This library is still heavily under construction. It is recommended that you do not use this library yet!**

## Project Goals

- Support the easy creation of console apps powered by PHP following the common use case of: `[options] command [arguments]`
- Provide implementations that support the debugging, profiling and analysis of SpraySole driven apps
- Completely self-contained and should not require any third-party userland libraries that are not bundled with the source
- Build all components using [SOLID][solid], readable and thoroughly unit-tested code

## Installation

##### For use

Right now the only supported method for installing SpraySole for use is by [downloading a zip file][spraysoledownload].

As the library matures Composer support will be added and the library available through Packagist.

Once you have installed SpraySole for use it is recommended that you alias your app's primary console command to: `/install/console.php`

##### For contributions

If you'd like to contribute to the SpraySole project you should install through Git:

```plain
git clone https://github.com/cspray/SpraySole.git
````

## Usage

```php
<?php

use \SpraySole\Application;
use \SpraySole\Input\ArgvInput;
use \SpraySole\Output\StreamOutput;

// this is /install/console.php

$App = new Application();

$App->addCommand(new \YourApp\CommandName());

$Input = new ArgvInput($argv);
$StdOut = new StreamOutput('php://stdin');
$StdErr = new StreamOutput('php://stderr');

// $StdErr is optional and will use $StdOut if not provided
$App->run($Input, $StdOut, $StdErr);

?>
```

Now, in your console you can execute your app and the commands associated to it. In the example below we'll assume that you have aliased `spraysole` to execute `/install/console.php` with PHP.

```
spraysole --foo bar --bar baz commandname arg1 arg2 arg3
```

[solid]: http://en.wikipedia.org/wiki/SOLID_(object-oriented_design) "S.O.L.I.D."
[spraysoledownload]: https://github.com/cspray/SpraySole/archive/master.zip "SpraySole Download"

