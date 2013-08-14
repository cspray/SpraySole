<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Input;

class ArgvInput implements Input {

    private $ArrayInput;

    public function __construct(array $args, array $alias = []) {
        $this->alias = $alias;
        list($parsedArgs, $parsedOptions) = $this->parseArgs($args, $alias);
        $this->ArrayInput = new ArrayInput($parsedArgs, $parsedOptions);
    }

    private function parseArgs(array $args, array $alias) {
        $parsedOptions = [];
        $parsedArgs = [];

        foreach($args as $arg) {
            if (isset($optionKey)) {
                $parsedOptions[$optionKey] = $arg;
            }
            $optionKey = null;

            if (\substr($arg, 0, 1) === '-' && \array_key_exists($arg, $alias)) {
                $arg = $this->alias[$arg];
            }

            if (\substr($arg, 0, 2) === '--') {
                $optionKey = \substr($arg, 2);
                $parsedOptions[$optionKey] = true;
                continue;
            }


        }

        return [$parsedArgs, $parsedOptions];
    }

    /**
     * Return an associative array of [flag => value]
     *
     * @return array
     */
    public function getOptions() {
        return $this->ArrayInput->getOptions();
    }

    /**
     * Return a single value that matches the $flag or null if no flag is present.
     *
     * @param string $flag
     * @return string|null
     */
    public function getOption($flag) {
        return $this->ArrayInput->getOption($flag);
    }

    /**
     * Return the argument at $argIndex or null if no argument is present
     *
     * @param integer $argIndex
     * @return string|null
     */
    public function getArgument($argIndex) {
        return $this->ArrayInput->getArgument($argIndex);
    }

    public function argumentsCount() {
        return $this->ArrayInput->argumentsCount();
    }
}
