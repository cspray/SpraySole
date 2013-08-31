<?php

/**
 * Abstract the sending of output to various sources.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole\Output;

interface Output {

    /**
     * Flag set when writing if the Formatter should be used to format the output
     * before it is sent to the user.
     */
    const OUTPUT_NORMAL = 'output_normal';

    /**
     * Flag set when writing if the Formatter should be skipped and the output
     * is sent directly to the user with no manipulation.
     */
    const OUTPUT_RAW = 'output_raw';

    /**
     * Flag set when writing if the Output should append a new line to the message
     * before it is sent to the user.
     */
    const APPEND_NEW_LINE = true;

    /**
     * Flag set when writing if the Output should NOT append a new line to the message
     * before it is sent to the user.
     */
    const DO_NOT_APPEND_NEW_LINE = false;

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
    public function write($message, $newLine = self::DO_NOT_APPEND_NEW_LINE, $formatType = self::OUTPUT_NORMAL);

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
