<?php // cli.php

require __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Application;

/** @var \Interop\Container\ContainerInterface $container */
$container = require __DIR__ . '/config/container.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = $container->get(\Doctrine\ORM\EntityManager::class);
$config = $container->get('config');

/** @var \Symfony\Component\Console\Application $cli */
$cli = new Application('ASPS Command Line Interface', 1);
$cli->setCatchExceptions(true);
$cli->setHelperSet(ConsoleRunner::createHelperSet($em));

// The HelperSet
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(
    [
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
        'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
    ]
);

$helpers = [];

/**
 * Doctrine ORM Config
 */
if (class_exists(\Doctrine\ORM\Version::class)) {
    $em = $container->get(\Doctrine\ORM\EntityManager::class);
    $helpers['em'] = new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em);

    $cli->addCommands(
        [
            // DBAL Commands
            new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
            new \Doctrine\DBAL\Tools\Console\Command\ImportCommand(),

            // ORM Commands
            new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
            new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
            new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),
            new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
            new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand(),
            new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand(),
            new \Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand(),
            new \Doctrine\ORM\Tools\Console\Command\InfoCommand()
        ]
    );
}

/**
 * Doctrine Migrations
 */
if (class_exists(\Doctrine\DBAL\Migrations\Version::class)) {
    $em = $container->get(\Doctrine\ORM\EntityManager::class);
    $db = $em->getConnection();

    $helperSet->set(new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em), 'em');
    $helperSet->set(new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($db), 'db');

    if (class_exists(\Symfony\Component\Console\Helper\QuestionHelper::class)) {
        $helperSet->set(new \Symfony\Component\Console\Helper\QuestionHelper(), 'question');
    }

    $cli->addCommands(
        [
            // Migrations Commands
            new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
            new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
            new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
            new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
            new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
            new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
        ]
    );
    //$cli = \Doctrine\DBAL\Migrations\Tools\Console\ConsoleRunner::createApplication($helperSet);
    //$cli->run();
}

// Add custom commands
//$cli->add($container->get(\Infrastructure\Symfony\Command\DiagnosticsCommand::class));
$cli->add($container->get(\Infrastructure\Doctrine\Command\ImportFixturesCommand::class));

// Set helpers
$helperSet = isset($helperSet) ? $helperSet : new \Symfony\Component\Console\Helper\HelperSet();
foreach ($helpers as $name => $helper) {
    $helperSet->set($helper, $name);
}

$cli->setHelperSet($helperSet);

$cli->run();
