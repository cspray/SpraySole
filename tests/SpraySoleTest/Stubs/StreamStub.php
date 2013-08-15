<?php
/**
 * A stub that will allow easy testing of operations performed on a stream
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Stubs;

class StreamStub {

    public $context;
    public static $body = '';
    public static $position = 0;

    public function stream_open($path, $mode, $options, &$opened_path) {
        return true;
    }

    public function stream_read($bytes) {
        $chunk = \substr(self::$body, self::$position, $bytes);
        self::$position += \strlen($chunk);
        return $chunk;
    }

    public function stream_write($data) {
        self::$body .= $data;
        return \strlen($data);
    }

    public function stream_eof() {
        return self::$position >= \strlen(self::$body);
    }

    public function stream_tell() {
        return self::$position;
    }

    public function stream_close() {
        return null;
    }

}
