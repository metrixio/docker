<?php

declare(strict_types=1);

namespace App\Application\Repository;

use Psr\SimpleCache\CacheInterface;
use Spiral\Cache\CacheStorageProviderInterface;

final class DockerCacheRepository implements DockerRepositoryInterface
{
    public const STORAGE_NAME = 'repositories';
    public const CACHE_KEY = 'docker.repositories';

    private readonly CacheInterface $cache;

    public function __construct(
        CacheStorageProviderInterface $provider,
    ) {
        $this->cache = $provider->storage(self::STORAGE_NAME);
    }

    public function all(): array
    {
        return $this->cache->get(self::CACHE_KEY) ?? [];
    }
}
