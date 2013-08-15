<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Output;

use \SpraySole\Output\StreamOutput;
use \SpraySoleTest\Stubs\StreamStub;

// registering the wrapper does not trigger autoloading so we have to manually include the file
require_once \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/Stubs/StreamStub.php';

class StreamOutputTest extends \PHPUnit_Framework_TestCase {

    public static function setUpBeforeClass() {
        \stream_wrapper_register('spraysoletest', '\\SpraySoleTest\\Stubs\\StreamStub');
    }

    public function testStreamOutputWritingMessageWithoutNewLinePassingStringStreamName() {
        $this->resetStream();
        $Output = new StreamOutput('spraysoletest://whatever');
        $Output->write('test message');

        $actual = StreamStub::$body;
        $this->assertSame('test message', $actual);
    }

    public function resetStream() {
        StreamStub::$body = '';
        StreamStub::$position = 0;
    }

    public static function tearDownAfterClass() {
        \stream_wrapper_unregister('spraysoletest');
    }

}
