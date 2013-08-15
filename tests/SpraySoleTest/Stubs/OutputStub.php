<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Stubs;

use SpraySole\Output\AbstractOutput;

class OutputStub extends AbstractOutput {


    /**
     * Write a line to the stream output; depending on $formatType passed will
     * format the message with the set Output\Formatter or the raw message with
     * no formatting.
     *
     * @param string $message
     * @param boolean $newLine
     * @param string $formatType
     * @return integer
     */
    public function write($message, $newLine = self::DO_NOT_APPEND_NEW_LINE, $formatType = self::OUTPUT_NORMAL) {
        return false;
    }
}
