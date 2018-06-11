<?php declare(strict_types = 1);

namespace Infrastructure\Doctrine\Factory;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * Class EntityManagerFactory
 *
 * @package    Infrastructure
 * @subpackage Doctrine\Factory
 * @author     Vasil Dakov <vasil.dakov@worldstores.co.uk>
 * @copyright  2017 Dunelm Group PLC
 */
final class EntityManagerFactory
{
    /**
     * @param  ContainerInterface $container
     * @return EntityManager
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config') ? $container->get('config') : [];

        // @codeCoverageIgnoreStart
        if (!isset($config['doctrine'])) {
            throw new ServiceNotCreatedException('Missing or invalid Doctrine configuration');
        }

        $config = $config['doctrine'];
        //var_dump($config['connection']['orm_default']); exit();

        $autoGenerateProxyClasses = (isset($config['configuration']['auto_generate_proxy_classes']))
            ? $config['configuration']['auto_generate_proxy_classes']
            : false;

        $underscoreNamingStrategy = (isset($config['configuration']['underscore_naming_strategy']))
            ? $config['configuration']['underscore_naming_strategy']
            : false;
        // @codeCoverageIgnoreEnd


        // Doctrine ORM configuration
        $doctrine = new Configuration();
        $doctrine->setProxyDir('data/doctrine/proxies');
        $doctrine->setProxyNamespace('Asps\Doctrine\Proxy');
        $doctrine->setAutoGenerateProxyClasses($autoGenerateProxyClasses);

        // Doctrine Naming Strategy
        // @codeCoverageIgnoreStart
        if ($underscoreNamingStrategy) {
            $doctrine->setNamingStrategy(new UnderscoreNamingStrategy());
        } // @codeCoverageIgnoreEnd

        // Doctrine ORM yaml mapping
        $driver = new \Doctrine\ORM\Mapping\Driver\XmlDriver('src/Infrastructure/src/Doctrine/Mapping');
        $doctrine->setMetadataDriverImpl($driver);

        // Doctrine Cache
        //$cache = $container->get(\Doctrine\Common\Cache\Cache::class);
        //$doctrine->setMetadataCacheImpl($cache);

        // Annotations support for the JMS Serializer
        //AnnotationRegistry::registerAutoloadNamespace('JMS\Serializer\Annotation', 'vendor/jms/serializer/src');

        // Doctrine Entity Manager
        $em = EntityManager::create($config['connection']['orm_default']['params'], $doctrine, null);

        $platform = $em->getConnection()->getDatabasePlatform();

        /* \Doctrine\DBAL\Types\Type::addType('SkuId', Type\SkuIdType::class);
        \Doctrine\DBAL\Types\Type::addType('ReservationId', Type\ReservationIdType::class);
        \Doctrine\DBAL\Types\Type::addType('LocationId', Type\LocationIdType::class);
        \Doctrine\DBAL\Types\Type::addType('BundleId', Type\BundleIdType::class);
        \Doctrine\DBAL\Types\Type::addType('BundleSkuId', Type\BundleSkuIdType::class);
        \Doctrine\DBAL\Types\Type::addType('ChannelId', Type\ChannelIdType::class);
        \Doctrine\DBAL\Types\Type::addType('SkuLocationId', Type\SkuLocationIdType::class);
        \Doctrine\DBAL\Types\Type::addType('PriceId', Type\PriceIdType::class);

        $platform->registerDoctrineTypeMapping('SkuId', 'SkuId');
        $platform->registerDoctrineTypeMapping('ReservationId', 'ReservationId');
        $platform->registerDoctrineTypeMapping('LocationId', 'LocationId');
        $platform->registerDoctrineTypeMapping('BundleId', 'BundleId');
        $platform->registerDoctrineTypeMapping('ChannelId', 'ChannelId');
        $platform->registerDoctrineTypeMapping('PriceId', 'PriceId'); */

        return $em;
    }
}
