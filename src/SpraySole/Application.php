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

    /**
     * @param \SpraySole\Command\Command $Command
     * @return void
     */
    public function addCommand(Command $Command) {

    }

    /**
     *
     *
     * @param string|Command $command
     * @return boolean
     */
    public function hasCommand($command) {

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

    }

}
