<?php declare(strict_types = 1);

namespace Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Infrastructure\Zend\Paginator\Adapter\DoctrinePaginator;


/**
 * Class ConfigProvider
 *
 * @package    Infrastructure
 * @author     Vasil Dakov <vasil.dakov@worldstores.co.uk>
 * @copyright  2017 Dunelm Group PLC
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
                // Doctrine Data Fixtures
                DataFixtures\Loader::class => DataFixtures\Loader::class,
                DataFixtures\Purger\ORMPurger::class => DataFixtures\Purger\ORMPurger::class,
            ],
            'factories'  => [
                // Redis
                //\Redis::class => Redis\RedisFactory::class,
                //\Infrastructure\Cache\Adapter\Redis\RedisCachePool::class => Redis\RedisCachePoolFactory::class,



                // Doctrine Factories
                EntityManager::class => Doctrine\Factory\EntityManagerFactory::class,
                DataFixtures\Executor\ORMExecutor::class => Doctrine\Factory\ORMExecutorFactory::class,
                //\Doctrine\Common\Cache\Cache::class => Doctrine\Factory\RedisCacheFactory::class,


                // Commands/Symfony
                Doctrine\Command\ImportFixturesCommand::class => Doctrine\Command\ImportFixturesCommandFactory::class,
                //Symfony\Command\DiagnosticsCommand::class => Symfony\Command\DiagnosticsCommandFactory::class,
                //Symfony\Command\ClearCacheCommand::class => Symfony\Command\ClearCacheCommandFactory::class,
                //Symfony\Command\ArchiveExpiredReservations::class => Symfony\Command\ArchiveExpiredReservationsFactory::class,
            ]
        ];
    }
}
