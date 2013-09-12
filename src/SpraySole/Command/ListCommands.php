<?php

/**
 * A Command provided "out of the box" that will list all added Command implementations
 * and their description.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole\Command;

use \SpraySole\Input\Input;
use \SpraySole\Output\Output;
use \SpraySole\ErrorCodes;

class ListCommands extends AbstractCommand {

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
        $layout = <<<TEXT
Commands available to this application

%s
TEXT;

        $innerFormat = <<<TEXT
%s\t\t\t%s

TEXT;

        $content = '';
        foreach ($this->App->getCommands() as $Command) {
            $content .= \sprintf($innerFormat, $Command->getName(), $Command->getDescription());
        }
        $content = \trim($content, \PHP_EOL);
        $content = \sprintf($layout, $content);
        $StdOut->write($content, Output::APPEND_NEW_LINE);

        return ErrorCodes::NO_ERROR;
    }

    public function getDescription() {
        return <<<TEXT
List all enabled Commands added to the running application
TEXT;
    }

}
