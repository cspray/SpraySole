<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Command;

use \SpraySole\Input\Input;
use \SpraySole\Output\Output;
use \SpraySole\Application;

interface Command {

    /**
     * @param \SpraySole\Application $App
     * @return mixed
     */
    public function setApplication(Application $App);

    /**
     * Return the description of the command.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Return the help output for the command.
     *
     * @return string
     */
    public function getHelp();

    /**
     * Return the name of the command as it would be typed into the console.
     *
     * @return string
     */
    public function getName();

    /**
     * Return whether the Command is enabled; you can set this to false if the
     * current environment prohibits the Command from being ran.
     *
     * @return boolean
     */
    public function isEnabled();

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
    public function execute(Input $Input, Output $StdOut, Output $StdErr);

}
