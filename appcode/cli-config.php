<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
return call_user_func(function () {
    /** @var \Interop\Container\ContainerInterface \$container */
    $container = require 'config/container.php';

    $entityManager = $container->get(\Doctrine\ORM\EntityManagerInterface::class);
    return ConsoleRunner::createHelperSet($entityManager);
});
