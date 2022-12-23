<?php

declare(strict_types=1);

namespace App\Api\GRPC;

use App\Application\Repository\DockerCacheRepository;
use App\Application\DockerRepositoryRegistry;
use GRPC\Docker\DockerServiceInterface;
use GRPC\Docker\AddRequest;
use GRPC\Docker\AddResponse;
use GRPC\Docker\AllRequest;
use GRPC\Docker\AllResponse;
use GRPC\Docker\RemoveRequest;
use GRPC\Docker\RemoveResponse;
use Psr\SimpleCache\CacheInterface;
use Spiral\Cache\CacheStorageProviderInterface;
use Spiral\RoadRunner\GRPC;

final class DockerService implements DockerServiceInterface
{
    private readonly CacheInterface $cache;

    public function __construct(
        private readonly DockerRepositoryRegistry $registry,
        CacheStorageProviderInterface $storageProvider
    ) {
        $this->cache = $storageProvider->storage(DockerCacheRepository::STORAGE_NAME);
    }

    public function Add(GRPC\ContextInterface $ctx, AddRequest $in): AddResponse
    {
        $this->registry->add($in->getRepo());
        $this->persist();

        return new AddResponse([
            'status' => true,
        ]);
    }

    public function Remove(GRPC\ContextInterface $ctx, RemoveRequest $in): RemoveResponse
    {
        $this->registry->add($in->getRepo());
        $this->persist();

        return new RemoveResponse([
            'status' => true,
        ]);
    }

    public function All(GRPC\ContextInterface $ctx, AllRequest $in): AllResponse
    {
        return new AllResponse([
            'repos' => $this->registry->getRepositories(),
        ]);
    }

    private function persist(): void
    {
        $this->cache->set(
            DockerCacheRepository::CACHE_KEY,
            $this->registry->getRepositories()
        );
    }
}
