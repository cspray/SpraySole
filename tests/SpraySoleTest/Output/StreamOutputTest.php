<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Output;

use \SpraySole\Output\Output;
use \SpraySole\Output\StreamOutput;
use \SpraySoleTest\Stubs\StreamStub;

class StreamOutputTest extends \PHPUnit_Framework_TestCase {

    public static function setUpBeforeClass() {
        \stream_wrapper_register('spraysoletest', '\\SpraySoleTest\\Stubs\\StreamStub');
    }

    public function setUp() {
        $this->resetStream();
    }

    public function testStreamOutputWritingMessageWithoutNewLinePassingStringStreamName() {
        $Output = new StreamOutput('spraysoletest://whatever');
        $Output->write('test message');

        $actual = StreamStub::$body;
        $this->assertSame('test message', $actual);
    }

    public function testStreamOutputWritingMessageWithNewLinePassingStringStreamName() {
        $Output = new StreamOutput('spraysoletest://whatever');
        $Output->write('message with new line', Output::APPEND_NEW_LINE);

        $actual = StreamStub::$body;
        $this->assertSame('message with new line' . \PHP_EOL, $actual);
    }

    public function resetStream() {
        StreamStub::$body = '';
        StreamStub::$position = 0;
    }

    public static function tearDownAfterClass() {
        \stream_wrapper_unregister('spraysoletest');
    }

}
