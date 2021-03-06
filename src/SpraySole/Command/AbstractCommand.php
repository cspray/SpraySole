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

use \SpraySole\Application;
use \SpraySole\Command\Command;
use \SpraySole\Output\Output;

/**
 * @property \SpraySole\Application $App
 */
abstract class AbstractCommand implements Command {

    /**
     * @property \SpraySole\Application
     */
    protected $App;

    private $options;

    public function __construct(array $options) {
        $options += ['name' => null, 'help_file' => null, 'description_file' => null];
        $this->options = $options;
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
        return $this->options['name'];
    }

    public function getHelp() {
        if (!\is_readable($file = $this->options['help_file'])) {
            $message = 'The help file: \'' . $file . '\' could not be found or is not readable';
            throw new Exception\InvalidResourceFileException($message);
        }

        return \file_get_contents($file);
    }

    public function getDescription() {
        if (!\is_readable($file = $this->options['description_file'])) {
            $message = 'The description file: \'' . $file . '\' could not be found or is not readable';
            throw new Exception\InvalidResourceFileException($message);
        }

        return \file_get_contents($file);
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
