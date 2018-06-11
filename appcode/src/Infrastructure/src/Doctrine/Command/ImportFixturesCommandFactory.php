<?php

namespace Infrastructure\Doctrine\Command;

use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class ImportFixturesCommandFactory
{
    /**
     * @param  ContainerInterface $container
     * @return ImportFixturesCommand
     */
    public function __invoke(ContainerInterface $container) : ImportFixturesCommand
    {
        $config = $container->get('config');

        if (!isset($config['doctrine']['fixtures'])) {
            throw new ServiceNotCreatedException('Missing Doctrine configuration');
        }

        $em       = $container->get(EntityManager::class);
        $loader   = $container->get(Loader::class);
        $executor = $container->get(ORMExecutor::class);
        $purger   = $container->get(ORMPurger::class);

        $command = new ImportFixturesCommand($em, $loader, $executor, $purger);
        $command->setPath($config['doctrine']['fixtures']['paths']);

        return $command;
    }
}
