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
        $HelpCmd = new Command\Help(
            ['name' => 'help', 'help_file' => $this->resourcesFile . '/help/help-command.txt'],
            $this->resourcesFile . '/help/spraysole.txt'
        );
        $LsCmd = new Command\ListCommands(['name' => 'ls', 'help_file' => $this->resourcesFile . '/help/ls-command.txt']);
        $App->addCommand($HelpCmd)->addCommand($LsCmd);
    }
}
