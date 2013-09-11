<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit\Command;

use \SpraySoleTest\Unit;
use \SpraySoleTest\Stubs\AbstractCommandStub;


class AbstractCommandTest extends Unit\TestCase {

    public function testAbstractCommandAlwaysEnabledByDefault() {
        $Cmd = new AbstractCommandStub([]);
        $this->assertTrue($Cmd->isEnabled(), 'The AbstractCommand is not properly enabled by default');
    }


    public function testSettingConfigWithHelpFilePathReturnsAppropriateHelp() {
        $Cmd = new AbstractCommandStub(['help_file' => \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/help.txt']);

        $expected = <<<TEXT
ran it

TEXT;

        $this->assertSame($expected, $Cmd->getHelp());
    }

    public function testSettingConfigWithDescriptionFilePathReturnsAppropriateText() {
        $Cmd = new AbstractCommandStub(['description_file' => \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/help-description.txt']);

        $expected = <<<TEXT
described it

TEXT;

        $this->assertsame($expected, $Cmd->getDescription());
    }

    public function testSettingConfigWithHelpFileNotReadableThrowsExceptionWhenHelpIsGotten() {
        $Cmd = new AbstractCommandStub(['help_file' => '/not/real/path']);
        $message = 'The help file: \'/not/real/path\' could not be found or is not readable';
        $this->setExpectedException('\\SpraySole\\Command\\Exception\\InvalidResourceFileException', $message);
        $Cmd->getHelp();
    }

    public function testSettingCommandWithDescriptionFileNotReadableThrowsExceptionWhenDescriptionIsGotten() {
        $Cmd = new AbstractCommandStub(['description_file' => '/not/real/path']);
        $message = 'The description file: \'/not/real/path\' could not be found or is not readable';
        $this->setExpectedException('\\SpraySole\\Command\\Exception\\InvalidResourceFileException', $message);
        $Cmd->getDescription();
    }




}
