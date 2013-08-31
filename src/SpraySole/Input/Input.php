<?php

/**
 * Abstract the parsing and retrieval of options and args coming from command line.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole\Input;

interface Input {

    /**
     * Return an associative array of [flag => value]
     *
     * @return array
     */
    public function getOptions();

    /**
     * Return a single value that matches the $flag or null if no flag is present.
     *
     * @param string $flag
     * @return string|null
     */
    public function getOption($flag);

    /**
     * Return the argument at $argIndex or null if no argument is present
     *
     * @param integer $argIndex
     * @return string|null
     */
    public function getArgument($argIndex);

    /**
     * @return integer
     */
    public function argumentsCount();


}
