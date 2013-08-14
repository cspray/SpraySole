<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Output;


abstract class AbstractOutput implements Output {


    private $Formatter;

    public function __construct(Formatter $Formatter) {
        $this->Formatter = $Formatter;
    }

    public function setFormatter(Formatter $Formatter) {
        $this->Formatter = $Formatter;
    }

    public function getFormatter() {
        return $this->Formatter;
    }

}
