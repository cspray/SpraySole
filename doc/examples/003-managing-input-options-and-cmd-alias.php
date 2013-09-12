<?php

/**
 * In this example we take a look at how you can provide command aliases and boolean
 * option flags to Input\ArgvInput to adjust how SpraySole parses the command line
 * input.
 */

use \SpraySole\Input\ArgvInput;

$optAliases = [
    '-alias' => '--real-option',
    '-f' => '--foo'
];

$boolOnlyOptions = [
    '--bar',
    '--foo',
    '--baz'
];

$Input = new ArgvInput($argv, $optAliases, $boolOnlyOptions);

/**
 * With this capability you can dictate whether or not it is ok for an option to
 * be aliased by something else so that if we come across, for example, '-f' in the
 * command line input we go ahead and swap that over to '--foo' for you; in your
 * Command code you now only have to keep up with the one option 'foo' and not
 * the aliases for it.
 *
 * The bool only options indicate that an option value should not be present and
 * that if the option is present automatically consider it a truthy value for
 * being present. This is a very important part of the ArgvInput object; let's
 * explain why.
 *
 * Given this input:
 *
 * spraysole --opt optvalue --foo command arg1 arg2 arg3
 *
 * Now, when you access $Input->getOption('opt') you get 'optvalue' and when you
 * access $Input->getOption('foo') you get true. However, if foo was not properly
 * marked as a boolean only option we would assign the 'command' value to it. Now
 * instead of command being recognized as the name of the command to invoke we
 * look for 'arg1' and you get a usage error.
 */


