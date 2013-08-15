<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Input;

class ArgvInput implements Input {

    private $ArrayInput;

    protected $defaultAliases = [
        '-v' => '--version'
    ];

    protected $defaultBoolOnly = [
        '--version'
    ];

    public function __construct(array $args, array $alias = [], array $boolOnlyFlags = []) {
        // we are overriding with defaults on purpose
        // this is to ensure that "magic" SpraySole functionality is provided
        $alias = \array_merge([], $alias, $this->defaultAliases);
        $boolOnlyFlags = \array_merge([], $boolOnlyFlags, $this->defaultBoolOnly);
        list($parsedArgs, $parsedOptions) = $this->parseArgs($args, $alias, $boolOnlyFlags);
        $this->ArrayInput = new ArrayInput($parsedArgs, $parsedOptions);
    }

    private function parseArgs(array $args, array $alias, array $boolOnlyFlags) {
        $parsedOptions = [];
        $parsedArgs = [];

        if (isset($args[0]) && \strpos($args[0], 'console.php')) {
            unset($args[0]);
        }

        $optionKey = null;
        $parsingArgs = false;
        foreach($args as $arg) {
            if (isset($optionKey)) {
                $index = $optionKey;
                $optionKey = null;

                if (\substr($arg, 0, 1) !== '-') {
                    $parsedOptions[$index] = $arg;
                    continue;
                }
            }

            if (\substr($arg, 0, 1) === '-' && \array_key_exists($arg, $alias)) {
                $arg = $alias[$arg];
            }

            if (\substr($arg, 0, 2) === '--') {
                if ($parsingArgs) {
                    $message = 'An option flag was provided after an argument and could not be parsed properly';
                    throw new Exception\InvalidInputException($message);
                }

                $optionKey = \substr($arg, 2);
                $parsedOptions[$optionKey] = true;
                if (\in_array($arg, $boolOnlyFlags)) {
                    $optionKey = null;
                }

                continue;
            }

            $parsingArgs = true;
            $parsedArgs[] = $arg;
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

    /**
     *
     *
     * @return int
     */
    public function argumentsCount() {
        return $this->ArrayInput->argumentsCount();
    }
}
