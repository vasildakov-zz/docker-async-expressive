<?php declare(strict_types=1);

namespace App\Distillery;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManager;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

/**
 * Class GetProductsFactory
 *
 * @author     Vasil Dakov <vasildakov@gmail.com>
 */
class GetDistilleriesHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new GetDistilleriesHandler(
            $container->get(EntityManager::class),
            $container->get(ResourceGenerator::class),
            $container->get(HalResponseFactory::class)
        );
    }
}
