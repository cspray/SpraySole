<?php

/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySoleTest\Unit\Command;

use \SpraySole\Command\Config;
use \SpraySoleTest\Stubs\AbstractCommandStub;

class AbstractCommandTest extends \PHPUnit_Framework_TestCase {

    public function testSettingConfigWithHelpFilePathReturnsAppropriateHelp() {
        $CmdConfig = new Config([
            Config::HELP_FILE_PARAM => \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/help.txt'
        ]);
        $Cmd = new AbstractCommandStub($CmdConfig);

        $expected = <<<TEXT
ran it

TEXT;

        $this->assertSame($expected, $Cmd->getHelp());
    }

    public function testSettingConfigWithDescriptionFilePathReturnsAppropriateText() {
        $CmdConfig = new Config([
            Config::DESCRIPTION_FILE_PARAM => \SPRAYSOLE_ROOT . '/tests/SpraySoleTest/_resources/help-description.txt'
        ]);
        $Cmd = new AbstractCommandStub($CmdConfig);

        $expected = <<<TEXT
described it

TEXT;

        $this->assertsame($expected, $Cmd->getDescription());
    }

    public function testSettingConfigWithHelpFileNotReadableThrowsExceptionWhenHelpIsGotten() {
        $CmdConfig = new Config([
            Config::HELP_FILE_PARAM => '/not/real/path'
        ]);
        $Cmd = new AbstractCommandStub($CmdConfig);

        $message = 'The help file: \'/not/real/path\' could not be found or is not readable';
        $this->setExpectedException('\\SpraySole\\Command\\Exception\\InvalidResourceFileException', $message);
        $Cmd->getHelp();
    }




}
