<?php

/**
 * An interface that represents a type capable of providing one or more Command
 * implementations to an Application.
 * 
 * @author  Charles Sprayberry
 * @license See LICENSE in source root
 * @version 0.1
 * @since   0.1
 */

namespace SpraySole\Provider;

use \SpraySole\Application;

interface CommandProvider {

    /**
     * Add the appropriate Command implementations to the Application.
     *
     * @param \SpraySole\Application $App
     * @return void
     */
    public function register(Application $App);

}
