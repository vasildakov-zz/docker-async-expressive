<?php declare(strict_types=1);

namespace Product;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class GetProductsFactory
 *
 * @author     Vasil Dakov <vasildakov@gmail.com>
 */
class GetProductsFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new GetProducts($container->get(EntityManager::class));
    }
}
