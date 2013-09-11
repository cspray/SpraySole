<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit\Output;

use \SpraySoleTest\Unit;
use \SpraySoleTest\Stubs\OutputStub;

class AbstractOutputTest extends Unit\TestCase {

    public function testGettingFormatterWithNoneSetReturnsNullFormatter() {
        $Output = new OutputStub();
        $Formatter = $Output->getFormatter();

        $this->assertInstanceOf('\\SpraySole\\Output\\Formatter\\NullFormatter', $Formatter);
    }

}
