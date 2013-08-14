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

}
