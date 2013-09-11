<?php

/* Using CommandProvider to, well, provide commands */

/**
 * In the first example we showed you how to add individual commands to an Application.
 * While this may be good for unit testing and quick & dirty work it isn't the
 * recommended method for adding Commands; the Provider\CommandProvider is.
 */

use \SpraySole\Application;
use \SpraySole\BasicApplication;
use \SpraySole\Provider\CommandProvider;

// This could be wherever is appropriate for your autoloading solution
class SomeCommandProvider implements CommandProvider {

    /**
     * Add the appropriate Command implementations to the Application.
     *
     * @param \SpraySole\Application $App
     * @return void
     */
    public function register(Application $App) {
        $App->addCommand(new \YourApp\Command\Foo());
        $App->addCommand(new \YourApp\Command\Bar());
        $App->addCommand(new \YourApp\Command\Baz());
    }

}

// Now you can adjust your app initialization code to look like

$App = new BasicApplication();
$App->registerProvider(new SomeCommandProvider());

/**
 * While the benefits of this method may not seem apparent now it will when your
 * Command implementations start gaining dependencies and are more complicated
 * to create. It allows you to easily create modules of Commands and add them at
 * runtime, perhaps based on some environment configuration.
 *
 * This method also allows your library holding SpraySole\Command implementations
 * to be more easily portable allowing more developers to take advantage of your
 * hard work.
 */
