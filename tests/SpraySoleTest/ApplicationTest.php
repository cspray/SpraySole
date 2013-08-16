<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest;

use \SpraySole\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase {

    public function testAddingCommandsGetsAssociativeArrayWhenGettingCommands() {
        $FooCmd = $this->getMock('\\SpraySole\\Command\\Command');
        $FooCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('foo'));
        $BarCmd = $this->getMock('\\SpraySole\\Command\\Command');
        $BarCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('bar'));
        $BazCmd = $this->getMock('\\SpraySole\\Command\\Command');
        $BazCmd->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('baz'));

        $App = new Application();
        $App->addCommand($FooCmd);
        $App->addCommand($BarCmd);
        $App->addCommand($BazCmd);

        $expected = ['foo' => $FooCmd, 'bar' => $BarCmd, 'baz' => $BazCmd];
        $this->assertSame($expected, $App->getCommands());
    }

}
