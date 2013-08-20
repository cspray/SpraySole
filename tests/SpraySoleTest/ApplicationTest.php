<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest;

use \SpraySole\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase {

    public function testAddingCommandsGetsAssociativeArrayWhenGettingCommands() {
        $FooCmd = $this->getMock('\\SpraySole\\Command\\Command');
        $FooCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('foo'));
        $BarCmd = $this->getMock('\\SpraySole\\Command\\Command');
        $BarCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('bar'));
        $BazCmd = $this->getMock('\\SpraySole\\Command\\Command');
        $BazCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('baz'));

        $App = new Application();
        $App->addCommand($FooCmd);
        $App->addCommand($BarCmd);
        $App->addCommand($BazCmd);

        $expected = ['foo' => $FooCmd, 'bar' => $BarCmd, 'baz' => $BazCmd];
        $this->assertSame($expected, $App->getCommands());
    }

    public function testHasCommandReturnsFalseWithNoCommandsAdded() {
        $App = new Application();
        $this->assertFalse($App->hasCommand('foo'));
    }

    public function testHasCommandReturnsTrueWithCommandAddedCheckingWithString() {
        $BarCmd = $this->getMock('\\SpraySole\\Command\\Command');
        $BarCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('bar'));

        $App = new Application();
        $App->addCommand($BarCmd);

        $this->assertTrue($App->hasCommand('bar'));
    }

    public function testNoArgsInputWriteUsageToOutput() {
        $Input = $this->getMock('\\SpraySole\\Input\\Input');
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(0));

        $message = <<<TEXT
No command was provided

usage:
    [options] command [arguments]
TEXT;
        $Output = $this->getMock('\\SpraySole\\Output\\Output');
        $Output->expects($this->once())
               ->method('write')
               ->with($message, true);

        $App = new Application();
        $App->run($Input, $Output);
    }

    public function testInputHasVersionCommandReturnsAppVersion() {
        $Input = $this->getMock('\\SpraySole\\Input\\Input');
        $Input->expects($this->once())
              ->method('getOption')
              ->with('version')
              ->will($this->returnValue(true));

        $message = <<<TEXT

TEXT;
        $Output = $this->getMock('\\SpraySole\\Output\\Output');
        $Output->expects($this->once())
               ->method('write')
               ->with($message, true);

        $App = new Application();
        $App->run($Input, $Output);
    }



}
