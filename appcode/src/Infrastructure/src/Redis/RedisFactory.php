<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 10/06/2018
 * Time: 20:42
 */

namespace Infrastructure\Redis;

use Interop\Container\ContainerInterface;
use Redis;

class RedisFactory
{
    /**
     * @param  ContainerInterface $container
     * @return Redis
     */
    public function __invoke(ContainerInterface $container) : Redis
    {
        //@codeCoverageIgnoreStart
        if (!extension_loaded('redis')) {
            throw new \RuntimeException('Redis extension is not loaded!');
        } //@codeCoverageIgnoreEnd

        $config = $container->has('config') ? $container->get('config') : [];

        if (!isset($config['redis'])) {
            throw new \InvalidArgumentException('Redis configuration is missing!');
        }

        $redis = new Redis();
        $redis->connect($config['redis']['host'], $config['redis']['port']);

        return $redis;
    }
}