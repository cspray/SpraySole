<?php
/**
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole\Command;



class Config {

    const NAME_PARAM = 'name';
    const HELP_FILE_PARAM = 'help-file';
    const DESCRIPTION_FILE_PARAM = 'description-file';

    private $default = [
        self::NAME_PARAM => '',
        self::HELP_FILE_PARAM => '',
        self::DESCRIPTION_FILE_PARAM => ''
    ];

    private $config;

    public function __construct(array $config) {
        $this->config = \array_merge([], $this->default, $config);
    }

    public function getName() {
        return $this->config[self::NAME_PARAM];
    }

    public function getHelpFile() {
        return $this->config[self::HELP_FILE_PARAM];
    }

    public function getDescriptionFile() {
        return $this->config[self::DESCRIPTION_FILE_PARAM];
    }

}
