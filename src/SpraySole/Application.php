<?php

/**
 * Interface that represents the primary responsibilities for a SpraySole app;
 * management of commands and the proper invocation of a command based on user input.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole;

use \SpraySole\Command\Command;
use \SpraySole\Input\Input;
use \SpraySole\Output\Output;

interface Application {

    /**
     * Parse the $Input and, if possible, execute the requested Command sending
     * output to the resources made available.
     *
     * @param \SpraySole\Input\Input $Input
     * @param \SpraySole\Output\Output $StdOut
     * @param \SpraySole\Output\Output $StdErr
     * @return integer
     */
    public function run(Input $Input, Output $StdOut, Output $StdErr = null);

    /**
     * Add a Command that is able to be executed by this Application
     *
     * @param \SpraySole\Command\Command $Command
     * @return \SpraySole\Application
     */
    public function addCommand(Command $Command);

    /**
     * Return all the Command implementations added to this Application
     *
     * @return \SpraySole\Command\Command[]
     */
    public function getCommands();

    /**
     * Returns true whether or not a Command identified by $cmdName has been
     * added to this Application.
     *
     * @param string $cmdName
     * @return boolean
     */
    public function hasCommand($cmdName);

    /**
     * Removes a Command identified by $cmdName that has been added to this
     * Application.
     *
     * @param string $cmdName
     * @return void
     */
    public function removeCommand($cmdName);

    /**
     * Register a CommandProvider to this Application that will supply one or
     * more commands to the Application.
     *
     * @param \SpraySole\CommandProvider $Provider
     * @return \SpraySole\Application
     */
    public function registerProvider(CommandProvider $Provider);

}
