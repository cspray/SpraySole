<?php
/**
 * Class that represents the executing logic of SpraySole that executes the appropriate
 * command.
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole;

use \SpraySole\Output\Output;
use \SpraySole\Input\Input;
use \SpraySole\Command\Command;

class Application {

    const SPRAYSOLE_VERSION = '0.1.0alpha';

    private $commands = [];

    /**
     * Provide a Command\Command that can be ran from your console app.
     *
     * @param \SpraySole\Command\Command $Command
     * @return \SpraySole\Application
     */
    public function addCommand(Command $Command) {
        $this->commands[$Command->getName()] = $Command;
        return $this;
    }

    /**
     * Determination based on the name of the command; if a string is passed it
     * is assumed to be the command name and if a Command\Command implementation
     * is passed the Command::getName will be used.
     *
     * @param string|Command $command
     * @return boolean
     */
    public function hasCommand($command) {
        return \array_key_exists($command, $this->commands);
    }

    /**
     * Return a collection of Command\Command implementations added to the Application.
     *
     * The collection should be returned so that when iterating over the collection
     * the name of the Command is the key while the Command itself is the value.
     *
     * @return \SpraySole\Command\Command[]
     */
    public function getCommands() {
        return $this->commands;
    }

    /**
     * Executes the logic to invoke a given Command based on $Input passed; all
     * normal app output should be written to $StdOut and error output to $StdErr.
     *
     * If $StdErr is null then the application can determine its own method for
     * writing error output.
     *
     * @param \SpraySole\Input\Input $Input
     * @param \SpraySole\Output\Output $StdOut
     * @param \SpraySole\Output\Output $StdErr
     * @return integer
     */
    public function run(Input $Input, Output $StdOut, Output $StdErr = null) {
        if ($version = $Input->getOption('version')) {
            $StdOut->write($this->getVersionMessage(), Output::APPEND_NEW_LINE);
            return;
        }

        if (!$Input->argumentsCount()) {
            $StdOut->write($this->getUsageMessage(), Output::APPEND_NEW_LINE);
            return;
        }

        $cmdName = $Input->getArgument(0);
        if (!$this->hasCommand($cmdName)) {
            $StdOut->write($this->getCommandNotFoundMessage($cmdName), Output::APPEND_NEW_LINE);
            return;
        }

        $StdErr = ($StdErr) ?: $StdOut;
        return $this->getCommands()[$cmdName]->execute($Input, $StdOut, $StdErr);
    }

    /**
     * @return string
     */
    private function getUsageMessage() {
        return <<<TEXT
No command was provided

usage:
    [options] command [arguments]
TEXT;
    }

    /**
     * @return string
     */
    private function getVersionMessage() {
        $version = self::SPRAYSOLE_VERSION;
        return <<<TEXT
SpraySole version {$version}
    A console driven application powered by PHP 5.4+
TEXT;
    }

    /**
     * @param string $name
     * @return string
     */
    private function getCommandNotFoundMessage($name) {
        return <<<TEXT
Command, {$name}, could not be found.

Please use --help or --help <command> for more information on using this application.
TEXT;

    }

}
