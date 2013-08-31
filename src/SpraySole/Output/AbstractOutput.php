<?php

/**
 * Simple abstract class providing support for getting and setting an Output\Formatter
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Output;

use \SpraySole\Output\Formatter\NullFormatter;

abstract class AbstractOutput implements Output {

    /**
     * @property \SpraySole\Output\Formatter
     */
    private $Formatter;

    /**
     * @param \SpraySole\Output\Formatter $Formatter
     */
    public function setFormatter(Formatter $Formatter) {
        $this->Formatter = $Formatter;
    }

    /**
     * This method ensures that you will always receive a Output\Formatter
     * implementation from this method; if one has not been set then a
     * Output\Formatter\NullFormatter will be set to the Formatter.
     *
     * @return \SpraySole\Output\Formatter
     */
    public function getFormatter() {
        if (!$this->Formatter) {
            $this->Formatter = new NullFormatter();
        }

        return $this->Formatter;
    }

}
