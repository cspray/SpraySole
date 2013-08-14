<?php

/**
 * A simple implementation of Input\Input that provides basic access to option
 * and argument parameters.
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Input;

class ArrayInput implements Input {

    /**
     * Numerically indexed array holding a list of arguments from the CLI
     *
     * @property array
     */
    private $args;

    /**
     * Associative indexed array holding a map of [flag => value] from the CLI
     *
     * @property array
     */
    private $options;

    /**
     * @param array $args
     * @param array $options
     */
    public function __construct(array $args = [], array $options = []) {
        $this->args = $args;
        $this->options = $options;
    }

    /**
     * Return an associative array of [flag => value]
     *
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Return a single value that matches
     *
     * @param string $flag
     * @return string|null
     */
    public function getOption($flag) {
        return isset($this->options[$flag]) ? $this->options[$flag] : null;
    }

    /**
     * Return the argument at $argIndex or null if no argument is present
     *
     * @param integer $argIndex
     * @return string|null
     */
    public function getArgument($argIndex) {
        return isset($this->args[$argIndex]) ? $this->args[$argIndex] : null;
    }

    /**
     *
     *
     * @return integer
     */
    public function argumentsCount() {
        return \count($this->args);
    }

}
