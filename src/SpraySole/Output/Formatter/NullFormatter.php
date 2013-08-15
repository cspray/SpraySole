<?php

/**
 * An Output\Formatter that will perform no modifications on the value and return
 * it as it was passed.
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Output\Formatter;

use \SpraySole\Output\Formatter;

class NullFormatter implements Formatter {

    /**
     * @param string $message
     * @return string
     */
    public function format($message) {
        return $message;
    }

}
