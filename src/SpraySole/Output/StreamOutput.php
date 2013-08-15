<?php

/**
 * Implementation of Output\Output that will send all messages to a stream resource.
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Output;

class StreamOutput extends AbstractOutput {

    /**
     * The stream we'll be sending messages to.
     *
     * @property resource
     */
    private $stream;

    /**
     * @param string|resource $stream
     */
    public function __construct($stream) {
        if (\is_string($stream)) {
            $stream = \fopen($stream, 'w');
        }

        $this->stream = $stream;
    }

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
    public function write($message, $newLine = false, $formatType = self::OUTPUT_NORMAL) {
        $message = $this->getFormatter()->format($message);

        if ($newLine) {
            $message .= \PHP_EOL;
        }
        return \fwrite($this->stream, $message);
    }

}
