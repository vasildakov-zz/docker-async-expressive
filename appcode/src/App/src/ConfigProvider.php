<?php

declare(strict_types=1);

namespace App;

use App\Distillery\DistilleryCollection;
use App\Distillery\GetDistilleriesHandler;
use App\Distillery\GetDistilleriesHandlerFactory;

use App\Product\GetProducts;
use App\Product\GetProductsFactory;
use App\Product\Product;
use App\Product\ProductCollection;

use Zend\Expressive\Hal\Metadata\MetadataMap;
use Zend\Expressive\Hal\Metadata\RouteBasedCollectionMetadata;
use Zend\Expressive\Hal\Metadata\RouteBasedResourceMetadata;
use Zend\Hydrator\ClassMethods;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            MetadataMap::class => $this->getMetadataMap(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                Handler\DistilleryHandler::class => Handler\DistilleryHandlerFactory::class,

                GetProducts::class => GetProductsFactory::class,
                GetDistilleriesHandler::class => GetDistilleriesHandlerFactory::class,
            ],
        ];
    }

    public function getMetadataMap() : array
    {
        return [
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => Distillery\Distillery::class,
                'route' => 'api.distillery',
                'extractor' => ClassMethods::class,
            ],
            [
                '__class__' => RouteBasedCollectionMetadata::class,
                'collection_class' => DistilleryCollection::class,
                'collection_relation' => 'distilleries',
                'route' => 'api.distilleries',
            ],
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => Product::class,
                'route' => 'api.product',
                'extractor' => ClassMethods::class,
            ],
            [
                '__class__' => RouteBasedCollectionMetadata::class,
                'collection_class' => ProductCollection::class,
                'collection_relation' => 'products',
                'route' => 'api.products',
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
