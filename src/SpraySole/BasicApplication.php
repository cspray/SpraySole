<?php

/**
 * Default implementation of the Application interface
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole;

use \SpraySole\Output\Output;
use \SpraySole\Input\Input;
use \SpraySole\Command\Command;
use \SpraySole\Provider\CommandProvider;

class BasicApplication implements Application {

    /**
     * The current release version of SpraySole
     */
    const SPRAYSOLE_VERSION = '0.1.0alpha';

    /**
     * @property \SpraySole\Command\Command[]
     */
    private $commands = [];

    /**
     * @property \SpraySole\Provider\CommandProvider[]
     */
    private $providers = [];

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
     * Returns true if a Command has been added that matches $cmdName
     *
     * @param string $cmdName
     * @return boolean
     */
    public function hasCommand($cmdName) {
        return \array_key_exists($cmdName, $this->commands);
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
        if ($Input->getOption('version')) {
            $StdOut->write($this->getVersionMessage(), Output::APPEND_NEW_LINE);
            return ErrorCodes::NO_ERROR;
        }

        if (!$Input->argumentsCount()) {
            $StdOut->write($this->getUsageMessage(), Output::APPEND_NEW_LINE);
            return ErrorCodes::BAD_INPUT;
        }

        foreach ($this->providers as $Provider) {
            /** @var \SpraySole\Provider\CommandProvider $Provider */
            $Provider->register($this);
        }

        $cmdName = $Input->getArgument(0);
        if (!$this->hasCommand($cmdName)) {
            $StdOut->write($this->getCommandNotFoundMessage($cmdName), Output::APPEND_NEW_LINE);
            return ErrorCodes::COMMAND_NOT_FOUND;
        }

        $StdErr = ($StdErr) ?: $StdOut;
        return $this->getCommands()[$cmdName]
                    ->setApplication($this)
                    ->execute($Input, $StdOut, $StdErr);
    }



    public function removeCommand($cmdName) {
        // TODO: Implement removeCommand() method.
    }

    /**
     * @param CommandProvider $Provider
     * @return \SpraySole\Application
     */
    public function registerProvider(CommandProvider $Provider) {
        $this->providers[] = $Provider;
        return $this;
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

Please use help or help <command-name> for more information on using this application.
TEXT;
    }

}
