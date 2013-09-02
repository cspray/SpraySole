<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit;

use \PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase {

    private $mocks = [
        'Input' => '\\SpraySole\\Input\\Input',
        'Output' => '\\SpraySole\\Output\\Output',
        'Formatter' => '\\SpraySole\\Output\\Formatter',
        'Command' => '\\SpraySole\\Command\\Command',
        'Provider' => '\\SpraySole\\Provider\\CommandProvider',
        'Application' => '\\SpraySole\\Application'
    ];

    protected function mocks($interface) {
        return isset($this->mocks[$interface]) ? $this->mocks[$interface] : null;
    }

}
