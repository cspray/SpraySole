<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Output;

use \SpraySoleTest\Stubs\OutputStub;

class AbstractOutputTest extends \PHPUnit_Framework_TestCase {

    public function testGettingFormatterWithNoneSetReturnsNullFormatter() {
        $Output = new OutputStub();
        $Formatter = $Output->getFormatter();

        $this->assertInstanceOf('\\SpraySole\\Output\\Formatter\\NullFormatter', $Formatter);
    }

}
