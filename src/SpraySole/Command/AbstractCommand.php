<?php

/**
 * Abstract implementation of a Command to provide basic, generic functionality.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole\Command;

use SpraySole\Application;
use \SpraySole\Command\Command;
use SpraySole\Output\Output;

abstract class AbstractCommand implements Command {

    /**
     * @property \SpraySole\Command\Command
     */
    protected $App;

    private $CmdConfig;

    private $name = '';

    public function __construct(Config $CmdConfig) {
        $this->CmdConfig = $CmdConfig;
    }

    /**
     * @param \SpraySole\Application $App
     * @return \SpraySole\Command\Command
     */
    public function setApplication(Application $App) {
        $this->App = $App;
        return $this;
    }

    /**
     * Return the name of the command as it would be typed into the console.
     *
     * @return string
     */
    public function getName() {
        if (!$this->name) {
            $this->name = $this->CmdConfig->getName();
        }

        return $this->name;
    }

    public function getHelp() {
        if (\is_readable($file = $this->CmdConfig->getHelpFile())) {
            return \file_get_contents($file);
        }
    }

    public function getDescription() {
        if (\is_readable($file = $this->CmdConfig->getDescriptionFile())) {
            return \file_get_contents($file);
        }
    }

    /**
     * Return whether the Command is enabled; you can set this to false if the
     * current environment prohibits the Command from being ran.
     *
     * @return boolean
     */
    public function isEnabled() {
        return true;
    }

}
