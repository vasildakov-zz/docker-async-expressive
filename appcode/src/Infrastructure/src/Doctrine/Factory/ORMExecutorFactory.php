<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 10/06/2018
 * Time: 20:23
 */

namespace Infrastructure\Doctrine\Factory;

use Doctrine\ORM\EntityManager;


use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

use Interop\Container\ContainerInterface;


class ORMExecutorFactory
{
    /**
     * @param   ContainerInterface   $container
     * @return  ORMExecutor
     */
    public function __invoke(ContainerInterface $container) : ORMExecutor
    {
        $em     = $container->get(EntityManager::class);
        $purger = $container->get(ORMPurger::class);

        return new ORMExecutor($em, $purger);
    }
}