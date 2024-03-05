<?php

declare(strict_types=1);

namespace App\Service;

use Redis;

class RedisService
{
    private readonly Redis $redis;

    public function __construct(string $redisHost, int $redisPort)
    {
        // Refactor using Symfony DI
        $this->redis = new Redis([
            'host' => $redisHost,
            'port' => $redisPort,
        ]);
    }

    public function storeIfNotExists(string $key, string $value): bool
    {
        $result = $this->redis->setnx($key, $value);
        $this->redis->expire($key, 10);

        return (bool) $result;
    }
}
