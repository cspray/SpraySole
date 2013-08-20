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

    private $commands = [];

    /**
     * Provide a Command\Command that can be ran from your console app.
     *
     * @param \SpraySole\Command\Command $Command
     * @return void
     */
    public function addCommand(Command $Command) {
        $this->commands[$Command->getName()] = $Command;
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
        if (!$Input->argumentsCount()) {
            $StdOut->write($this->getUsageMessage(), Output::APPEND_NEW_LINE);
        }
    }

    private function getUsageMessage() {
        return <<<TEXT
No command was provided

usage:
    [options] command [arguments]
TEXT;

    }

}
