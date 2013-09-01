<?php

/**
 * A CommandProvider implementation that adds some "out of the box" SpraySole
 * commands to the Application.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole\Provider;

use \SpraySole\Application;
use \SpraySole\CommandProvider;
use \SpraySole\Command;

class DefaultCommandProvider implements CommandProvider {

    private $resourcesFile = '';

    public function __construct() {
        $this->resourcesFile = \dirname(__DIR__) . '/_resources';
    }

    /**
     * @param \SpraySole\Application $App
     * @return void
     */
    public function register(Application $App) {
        $HelpCmd = new Command\Help(new Command\Config([
            Command\Config::NAME_PARAM => 'help',
            Command\Config::HELP_FILE_PARAM => $this->resourcesFile . '/help/help-command.txt',
            Command\Config::DESCRIPTION_FILE_PARAM => $this->resourcesFile . '/description/help-description.txt'
        ]), $this->resourcesFile . '/help/spraysole.txt');
        $LsCmd = new Command\Ls(new Command\Config([
            Command\Config::NAME_PARAM => 'ls',
            Command\Config::HELP_FILE_PARAM => $this->resourcesFile . '/help/ls-command.txt'
        ]));
        $App->addCommand($HelpCmd)
            ->addCommand($LsCmd);
    }
}
