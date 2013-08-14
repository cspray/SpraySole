<?php

/**
 * Provide the ability to format messages sent to the console in different ways.
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Output;


interface Formatter {

    /**
     * @param string $message
     * @return string
     */
    public function format($message);

}
