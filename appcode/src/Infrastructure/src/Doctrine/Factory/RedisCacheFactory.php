<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 10/06/2018
 * Time: 20:26
 */

namespace Infrastructure\Doctrine\Factory;

use Redis;
use Doctrine\Common\Cache\RedisCache;
use Interop\Container\ContainerInterface;

class RedisCacheFactory
{
    /**
     * @param  ContainerInterface   $container
     * @return RedisCache           $cache
     */
    public function __invoke(ContainerInterface $container) : RedisCache
    {
        $cache = new RedisCache();
        $cache->setRedis($container->get(Redis::class));
        return $cache;
    }
}