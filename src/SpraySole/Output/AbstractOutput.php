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






}
