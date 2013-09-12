<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit;

use \SpraySole\BasicApplication;
use \SpraySole\ErrorCodes;

class BasicApplicationTest extends TestCase {

    public function testAddingCommandsGetsAssociativeArrayWhenGettingCommands() {
        $FooCmd = $this->getMock($this->mocks('Command'));
        $FooCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('foo'));
        $BarCmd = $this->getMock($this->mocks('Command'));
        $BarCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('bar'));
        $BazCmd = $this->getMock($this->mocks('Command'));
        $BazCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('baz'));

        $App = new BasicApplication();
        $App->addCommand($FooCmd);
        $App->addCommand($BarCmd);
        $App->addCommand($BazCmd);

        $expected = ['foo' => $FooCmd, 'bar' => $BarCmd, 'baz' => $BazCmd];
        $this->assertSame($expected, $App->getCommands());
    }

    public function testHasCommandReturnsFalseWithNoCommandsAdded() {
        $App = new BasicApplication();
        $this->assertFalse($App->hasCommand('foo'));
    }

    public function testHasCommandReturnsTrueWithCommandAddedCheckingWithString() {
        $BarCmd = $this->getMock($this->mocks('Command'));
        $BarCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('bar'));

        $App = new BasicApplication();
        $App->addCommand($BarCmd);

        $this->assertTrue($App->hasCommand('bar'));
    }

    public function testNoArgsInputWriteUsageToOutput() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(0));

        $message = <<<TEXT
No command was provided

usage:
    [options] command [arguments]
TEXT;
        $Output = $this->getMock($this->mocks('Output'));
        $Output->expects($this->once())
               ->method('write')
               ->with($message, true);

        $App = new BasicApplication();
        $App->run($Input, $Output);
    }

    public function testNoArgsInputReturnsErrorCode() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(0));

        $exitCode = (new BasicApplication())->run($Input, $this->getMock($this->mocks('Output')));
        $this->assertSame(ErrorCodes::BAD_INPUT, $exitCode);
    }

    public function testInputHasVersionOptionReturnsAppVersion() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('getOption')
              ->with('version')
              ->will($this->returnValue(true));

        $message = <<<TEXT
SpraySole version 0.1.0alpha
    A console driven application powered by PHP 5.4+
TEXT;
        $Output = $this->getMock($this->mocks('Output'));
        $Output->expects($this->once())
               ->method('write')
               ->with($message, true);

        $App = new BasicApplication();
        $App->run($Input, $Output);
    }

    public function testInputHavingVersionReturnsAppropriateErrorCodeNoError() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('getOption')
              ->with('version')
              ->will($this->returnValue(true));

        $exitCode = (new BasicApplication())->run($Input, $this->getMock($this->mocks('Output')));
        $this->assertSame(ErrorCodes::NO_ERROR, $exitCode);
    }

    public function testCommandNotFoundGivesAppropriateErrorMessage() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(2));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(0)
              ->will($this->returnValue('not-listed'));

        $message = <<<TEXT
Command, not-listed, could not be found.

Please use help or help <command-name> for more information on using this application.
TEXT;
        $Output = $this->getMock($this->mocks('Output'));
        $Output->expects($this->once())
               ->method('write')
               ->with($message, true);

        $App = new BasicApplication();
        $App->run($Input, $Output);
    }

    public function testCommandNotFoundGivesAppropriateErrorCodeNotFound() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(2));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(0)
              ->will($this->returnValue('not-listed'));

        $exitCode = (new BasicApplication())->run($Input, $this->getMock($this->mocks('Output')));
        $this->assertSame($exitCode, ErrorCodes::COMMAND_NOT_FOUND);
    }

    public function testAppRunsCommandFoundAndReturnsThatCommandsExitCode() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(1));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(0)
              ->will($this->returnValue('command-name'));

        $Output = $this->getMock($this->mocks('Output'));
        $Output->expects($this->never())->method('write');

        $Command = $this->getMock($this->mocks('Command'));
        $Command->expects($this->once())
                ->method('getName')
                ->will($this->returnValue('command-name'));
        $App = (new BasicApplication())->addCommand($Command);

        $Command->expects($this->once())
                ->method('setApplication')
                ->with($App)
                ->will($this->returnSelf());
        $Command->expects($this->once())
                ->method('execute')
                ->with($Input, $Output, $Output)
                ->will($this->returnValue(0));

        $code = $App->run($Input, $Output);
        $this->assertSame(0, $code);
    }

    public function testAppSetApplicationOnCommandBeforeCommandIsInvoked() {
        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(1));
        $Input->expects($this->once())
              ->method('getArgument')
              ->with(0)
              ->will($this->returnValue('command-name'));

        $Output = $this->getMock($this->mocks('Output'));
        $Output->expects($this->never())->method('write');

        $App = new BasicApplication();

        $Command = $this->getMock($this->mocks('Command'));
        $Command->expects($this->at(0))
                ->method('getName')
                ->will($this->returnValue('command-name'));
        $Command->expects($this->at(1))
                ->method('setApplication')
                ->with($App)
                ->will($this->returnSelf());
        $Command->expects($this->at(2))
                ->method('execute')
                ->with($Input, $Output, $Output)
                ->will($this->returnValue(0));


        $App->addCommand($Command);
        $code = $App->run($Input, $Output);
        $this->assertSame(0, $code);
    }

    public function testAppRegisteringProviderInvokesAllProvidersBeforeParsingOnRun() {
        $FooProvider = $this->getMock($this->mocks('Provider'));
        $BarProvider = $this->getMock($this->mocks('Provider'));
        $BazProvider = $this->getMock($this->mocks('Provider'));

        $App = new BasicApplication();
        $App->registerProvider($FooProvider)
            ->registerProvider($BarProvider)
            ->registerProvider($BazProvider);

        $FooProvider->expects($this->once())
                    ->method('register')
                    ->with($App);
        $BarProvider->expects($this->once())
                    ->method('register')
                    ->with($App);
        $BazProvider->expects($this->once())
                    ->method('register')
                    ->with($App);

        $Input = $this->getMock($this->mocks('Input'));
        $Input->expects($this->once())
              ->method('argumentsCount')
              ->will($this->returnValue(1));

        $App->run($Input, $this->getMock($this->mocks('Output')));
    }

    public function testRemovingAddedCommandFromApplication() {
        $Cmd = $this->getMock($this->mocks('Command'));
        $Cmd->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('foo'));

        $App = new BasicApplication();
        $App->addCommand($Cmd);
        $this->assertTrue($App->hasCommand('foo'), 'The app does not have the added command');
        $App->removeCommand('foo');
        $this->assertFalse($App->hasCommand('foo'), 'The app still has the command although it has been removed');

    }

}
