<?php

/**
 * A Command provided "out of the box" to provide detailed information on SpraySole
 * usage and to provide access to the help details provided by a Command.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole\Command;

use \SpraySole\Input\Input;
use \SpraySole\Output\Output;
use \SpraySole\Command\Config;

class Help extends AbstractCommand {

    private $appHelpFile;

    public function __construct(Config $CmdConfig, $appHelpFile) {
        parent::__construct($CmdConfig);
        $this->appHelpFile = (string) $appHelpFile;
    }

    /**
     * Return the description of the command.
     *
     * @return string
     */
    public function getDescription() {
        return <<<TEXT
Provide details on how to use SpraySole or a specific command.
TEXT;
    }

    /**
     * Execute the given Command based on the Input, writing whatever Output is
     * necessary based on any normal processing or errors; return an exit code
     * or 0 if there was no error.
     *
     * @param \SpraySole\Input\Input $Input
     * @param \SpraySole\Output\Output $StdOut
     * @param \SpraySole\Output\Output $StdErr
     * @return integer
     */
    public function execute(Input $Input, Output $StdOut, Output $StdErr) {
        if (!$cmdName = $Input->getArgument(1)) {
            $StdOut->write(\file_get_contents($this->appHelpFile), Output::APPEND_NEW_LINE);
            return 0;
        }

        if ($cmdName === 'help') {
            $StdOut->write($this->getHelp(), Output::APPEND_NEW_LINE);
            return 0;
        }

        if ($this->App->hasCommand($cmdName)) {
            $StdOut->write($this->App->getCommands()[$cmdName]->getHelp(), Output::APPEND_NEW_LINE);
            return 0;
        }

    }

}
