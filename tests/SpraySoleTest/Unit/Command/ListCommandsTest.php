<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit\Command;

use \SpraySole\Command\Config;
use \SpraySole\Command\ListCommands;
use \SpraySole\ErrorCodes;
use \SpraySoleTest\Unit;

class ListCommandsTest extends Unit\TestCase {

    public function testListThreeCommandsAddedToApp() {
        $FooCmd = $this->getMock($this->mocks('Command'));
        $BarCmd = $this->getMock($this->mocks('Command'));
        $BazCmd = $this->getMock($this->mocks('Command'));

        $FooCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('foo'));
        $FooCmd->expects($this->once())
               ->method('getDescription')
               ->will($this->returnValue('foo description'));
        $BarCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('bar'));
        $BarCmd->expects($this->once())
               ->method('getDescription')
               ->will($this->returnValue('bar description'));
        $BazCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('baz'));
        $BazCmd->expects($this->once())
               ->method('getDescription')
               ->will($this->returnValue('baz description'));

        $App = $this->getMock($this->mocks('Application'));
        $App->expects($this->once())
            ->method('getCommands')
            ->will($this->returnValue([$FooCmd, $BarCmd, $BazCmd]));


        $expected = <<<TEXT
Commands available to this application

foo\t\t\tfoo description
bar\t\t\tbar description
baz\t\t\tbaz description
TEXT;

        $StdOut = $this->getMock($this->mocks('Output'));
        $StdOut->expects($this->once())
               ->method('write')
               ->with($expected, true);
        $StdErr = $this->getMock($this->mocks('Output'));
        $StdErr->expects($this->never())
               ->method('write');

        $ListCmd = (new ListCommands(['name' => 'ls']))->setApplication($App);
        $exitCode = $ListCmd->execute($this->getMock($this->mocks('Input')), $StdOut, $StdErr);
        $this->assertSame(ErrorCodes::NO_ERROR, $exitCode);
    }

}
