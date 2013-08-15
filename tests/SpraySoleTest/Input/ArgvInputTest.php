<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Input;

use \SpraySole\Input\ArgvInput;

class ArgvInputTest extends \PHPUnit_Framework_TestCase {

    public function testGetOptionsReturnsEmptyArrayWithNoArgs() {
        $args = [];
        $Input = new ArgvInput($args);

        $this->assertSame([], $Input->getOptions(), 'The options returned is not an empty array when no args passed');
    }

    public function testGetArgsReturnsNullForFirstIndexWithNoArgs() {
        $args = [];
        $Input = new ArgvInput($args);

        $this->assertSame(null, $Input->getArgument(0), 'The first argument returned is not null when no args passed');
    }

    public function testOneOptionFlagReturnsValueProperly() {
        $args = [
            '--foo',
            'bar'
        ];
        $Input = new ArgvInput($args);

        $this->assertSame('bar', $Input->getOption('foo'), 'A single flag is not parsed properly with the correct value');
    }

    public function testTwoOptionFlagsReturnsValuesProperly() {
        $args = [
            '--foo',
            'bar',
            '--bar',
            'foo'
        ];
        $Input = new ArgvInput($args);

        $this->assertSame('bar', $Input->getOption('foo'));
        $this->assertSame('foo', $Input->getOption('bar'));
    }

    public function testOptionWithNoParameterTreatedAsBooleanOption() {
        $args = [
            '--foo'
        ];
        $Input = new ArgvInput($args);

        $this->assertTrue($Input->getOption('foo'));
    }

    public function testAliasOptionsAreSetAsLongVersion() {
        $args = [
            '-f',
            'alias of --foo'
        ];
        $alias = [
            '-f' => '--foo'
        ];
        $Input = new ArgvInput($args, $alias);

        $this->assertSame('alias of --foo', $Input->getOption('foo'));
    }

    public function testParsingOneArgWithNoOptions() {
        $args = [
            'spraysole'
        ];
        $Input = new ArgvInput($args);

        $this->assertSame('spraysole', $Input->getArgument(0));
    }

    public function testOptionsAfterFirstArgThrowsException() {
        $args = [
            '--foo',
            'bar',
            'arg1',
            '--invalid',
            'flag'
        ];

        $message = 'An option flag was provided after an argument and could not be parsed properly';
        $this->setExpectedException('\\SpraySole\\Input\\Exception\\InvalidInputException', $message);
        $Input = new ArgvInput($args);
    }

    public function testMultipleBooleanOptionsParsedProperly() {
        $args = [
            '--bool1',
            '--bool2'
        ];

        $Input = new ArgvInput($args);

        $this->assertTrue($Input->getOption('bool1'));
        $this->assertTrue($Input->getOption('bool2'));
    }

    public function testFirstArgHasConsoleFileNameIsRemoved() {
        $args = [
            '/path/to/console.php',
            '--bool1',
        ];

        $Input = new ArgvInput($args);

        $this->assertTrue($Input->getOption('bool1'));
    }

    public function testBoolOnlyOptionDoesNotCapturePrecedingArgs() {
        $args = [
            '--bool1',
            '--bool2',
            'arg1',
            'arg2'
        ];
        $aliases = [];
        $boolOnly = ['--bool1', '--bool2'];

        $Input = new ArgvInput($args, $aliases, $boolOnly);

        $this->assertTrue($Input->getOption('bool1'));
        $this->assertTrue($Input->getOption('bool2'));
        $this->assertSame($Input->getArgument(0), 'arg1');
        $this->assertSame($Input->getArgument(1), 'arg2');
    }

    public function testVersionAliasEnabledByDefault() {
        $args = [
            '-v'
        ];

        $Input = new ArgvInput($args);

        $this->assertTrue($Input->getOption('version'));
    }

    public function testVersionFlagIsBooleanOnlyByDefault() {
        $args = [
            '--version',
            'bar',
            'baz'
        ];

        $Input = new ArgvInput($args);

        $this->assertTrue($Input->getOption('version'));
        $this->assertSame('bar', $Input->getArgument(0));
        $this->assertSame('baz', $Input->getArgument(1));
    }

}
