<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit\Command;

use \SpraySole\Command\Help;
use \SpraySole\ErrorCodes;
use \SpraySoleTest\Unit;


class HelpTest extends Unit\TestCase {

    private $options = [];

    public function setUp() {
        $this->options['name'] = 'help';
    }

    public function testGettingHelpCommandName() {
        $Cmd = new Help($this->options, '');
        $this->assertSame('help', $Cmd->getName());
    }

    public function testGettingHelpDescription() {
        $Cmd = new Help($this->options, '');
        $expected = <<<TEXT
Provide details on how to use SpraySole or a specific command.
TEXT;
        $this->assertSame($expected, $Cmd->getDescription());
    }

    public function testGettingSpraySoleHelp() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(1)
              ->will($this->returnValue(null));

        $expected = <<<TEXT
all the things

TEXT;


        // We are using different output mocks to make sure we are writing to stdout and not stderr
        $StdOut = $this->getMock($this->mocks('Output'));
        $StdOut->expects($this->once())
               ->method('write')
               ->with($expected, true);
        $StdErr = $this->getMock($this->mocks('Output'));

        $Cmd = new Help($this->options, \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/spraysole.txt');
        $code = $Cmd->execute($Input, $StdOut, $StdErr);
        $this->assertSame(ErrorCodes::NO_ERROR, $code, 'The error code is indicative of an error');
    }

    public function testGetSpraySoleHelpHelp() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(1)
              ->will($this->returnValue('help'));

        // We are using different output mocks to make sure we are writing to stdout and not stderr
        $StdOut = $this->getMock($this->mocks('Output'));
        $StdOut->expects($this->once())
               ->method('write')
               ->with('ran it' . \PHP_EOL);
        $StdErr = $this->getMock($this->mocks('Output'));

        $options = $this->options;
        $options['help_file'] = \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/help.txt';

        $Cmd = new Help($options, '');
        $code = $Cmd->execute($Input, $StdOut, $StdErr);
        $this->assertSame(ErrorCodes::NO_ERROR, $code, 'The error code is indicative of an error');
    }

    public function testGetAddedCommandHelp() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(1)
              ->will($this->returnValue('foo'));

        $StdOut = $this->getMock($this->mocks('Output'));
        $StdOut->expects($this->once())
               ->method('write')
               ->with('foo command help');
        $StdError = $this->getMock($this->mocks('Output'));

        $FooCmd = $this->getMock($this->mocks('Command'));
        $FooCmd->expects($this->once())
               ->method('getHelp')
               ->will($this->returnValue('foo command help'));

        $App = $this->getMock($this->mocks('Application'));
        $App->expects($this->once())
            ->method('hasCommand')
            ->with('foo')
            ->will($this->returnValue(true));

        $App->expects($this->once())
            ->method('getCommands')
            ->will($this->returnValue(['foo' => $FooCmd]));

        $Cmd = new Help($this->options, '');
        $Cmd->setApplication($App);
        $code = $Cmd->execute($Input, $StdOut, $StdError);

        $this->assertSame(ErrorCodes::NO_ERROR, $code);
    }

    public function testGettingHelpForCommandNotAdded() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(1)
              ->will($this->returnValue('foo'));

        $expectedOutput = <<<TEXT
The command 'foo' has not been added to this application
TEXT;

        $StdOut = $this->getMock($this->mocks('Output'));
        $StdOut->expects($this->once())
               ->method('write')
               ->with($expectedOutput, true);
        $StdError = $this->getMock($this->mocks('Output'));
        $StdError->expects($this->never())
                 ->method('write');

        $App = $this->getMock($this->mocks('Application'));
        $App->expects($this->once())
            ->method('hasCommand')
            ->with('foo')
            ->will($this->returnValue(false));

        $Cmd = new Help($this->options, '');
        $Cmd->setApplication($App);
        $code = $Cmd->execute($Input, $StdOut, $StdError);

        $this->assertSame(ErrorCodes::COMMAND_NOT_FOUND, $code);
    }


}
