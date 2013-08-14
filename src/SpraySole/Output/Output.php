<?php

/**
 * Abstract the sending of output to various console streams.
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Output;

interface Output {

    const OUTPUT_NORMAL = 'output_normal';
    const OUTPUT_RAW = 'output_raw';

    /**
     * Write a line to the stream output; depending on $formatType passed will
     * format the message with the set Output\Formatter or the raw message with
     * no formatting.
     *
     * @param string $message
     * @param boolean $newLine
     * @param string $formatType
     * @return string
     */
    public function write($message, $newLine = false, $formatType = self::OUTPUT_NORMAL);

    /**
     * Set the Output\Formatter that should be used when writing messages.
     *
     * @param \SpraySole\Output\Formatter $Formatter
     * @return void
     */
    public function setFormatter(Formatter $Formatter);

    /**
     * @return \SpraySole\Output\Formatter
     */
    public function getFormatter();

}
