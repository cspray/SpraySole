<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit\Command;

use \SpraySole\Command\Help;
use \SpraySole\Command\Config;
use \SpraySoleTest\Unit;


class HelpTest extends Unit\TestCase {

    private $CmdConfig;

    public function setUp() {
        $this->CmdConfig = new Config([
            Config::NAME_PARAM => 'help'
        ]);
    }

    public function testGettingHelpCommandName() {
        $Cmd = new Help($this->CmdConfig, '');
        $this->assertSame('help', $Cmd->getName());
    }

    public function testGettingHelpDescription() {
        $Cmd = new Help($this->CmdConfig, '');
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

        $Cmd = new Help($this->CmdConfig, \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/spraysole.txt');
        $code = $Cmd->execute($Input, $StdOut, $StdErr);
        $this->assertSame(0, $code, 'The error code is indicative of an error');
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

        $CmdConfig = new Config([
            Config::NAME_PARAM => 'help',
            Config::HELP_FILE_PARAM => \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/help.txt'
        ]);
        $Cmd = new Help($CmdConfig, '');
        $code = $Cmd->execute($Input, $StdOut, $StdErr);
        $this->assertSame(0, $code, 'The error code is indicative of an error');
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

        $App = $this->getMock($this->mocks('Application'));
        $App->expects($this->once())
            ->method('hasCommand')
            ->with('foo')
            ->will($this->returnValue(true));

        $FooCmd = $this->getMock($this->mocks('Command'));
        $FooCmd->expects($this->once())
               ->method('getHelp')
               ->will($this->returnValue('foo command help'));

        $App->expects($this->once())
            ->method('getCommands')
            ->will($this->returnValue(['foo' => $FooCmd]));

        $Cmd = new Help($this->CmdConfig, '');
        $Cmd->setApplication($App);
        $code = $Cmd->execute($Input, $StdOut, $StdError);

        $this->assertSame(0, $code);
    }


}
