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
        $Cmd = new Help($this->CmdConfig);
        $this->assertSame('help', $Cmd->getName());
    }

    public function testGettingHelpDescription() {
        $Cmd = new Help($this->CmdConfig);
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

        // We are using different output mocks to make sure we are writing to stdout and not stderr
        $StdOut = $this->getMock($this->mocks('Output'));
        $StdOut->expects($this->once())
               ->method('write');
        $StdErr = $this->getMock($this->mocks('Output'));

        $Cmd = new Help($this->CmdConfig);
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
               ->method('write');
        $StdErr = $this->getMock($this->mocks('Output'));

        $Cmd = new Help($this->CmdConfig);
        $code = $Cmd->execute($Input, $StdOut, $StdErr);
        $this->assertSame(0, $code, 'The error code is indicative of an error');
    }


}
