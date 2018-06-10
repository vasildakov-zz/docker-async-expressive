<?php

namespace Infrastructure\Cache\Adapter\Redis;

use Cache\Adapter\Common\CacheItem;

class RedisCachePool
{
    public function getItems(iterable $keys = [])
    {
        $pipeline = $this->cache->multi();

        foreach ($keys as $key) {
            $pipeline->get($key);
        }

        $items = $pipeline->exec();
        $returnItems = [];

        foreach ($items as $key => $item) {
            if (empty($item)) {
                continue;
            }

            $cacheKey = $keys[$key];

            if (!is_object($item)) {
                $item = unserialize($item);
            }

            $returnItems[$cacheKey] = (new CacheItem($cacheKey))->set($item);
        }

        return $returnItems;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItems(array $keys)
    {
        $pipeline = $this->cache->multi();
        $pipeline->delete($keys);
        $pipeline->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        $pipeline = $this->cache->multi();

        if (!empty($this->deferred)) {
            foreach ($this->deferred as $key => $item) {
                $pipeline->set($key, $item->get());
            }
        }

        $pipeline->exec();
    }
}