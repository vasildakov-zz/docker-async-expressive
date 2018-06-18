<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 16/06/2018
 * Time: 12:27
 */

namespace App\Product;

use Infrastructure\Zend\Paginator\Adapter\DoctrinePaginator;
use Psr\Container\ContainerInterface;

class ProductCollectionFactory
{
    public function __invoke(ContainerInterface $container) : ProductCollection
    {
        return new ProductCollection($container->get(DoctrinePaginator::class));
    }
}
