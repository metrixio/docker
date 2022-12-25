<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Application\DockerRepositoryRegistry;
use App\Application\Repository\DockerCacheRepository;
use App\Application\Repository\DockerConfigRepository;
use App\Application\Repository\DockerEvnRepository;
use App\Infrastructure\Docker\Client;
use App\Infrastructure\Docker\ClientInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Symfony\Component\HttpClient\NativeHttpClient;

final class DockerBootloader extends Bootloader
{
    protected const BINDINGS = [
        ClientInterface::class => [self::class, 'initDockerClient'],
        DockerRepositoryRegistry::class => [self::class, 'initDockerRegistry'],
    ];

    private function initDockerRegistry(
        DockerConfigRepository $configRepository,
        DockerEvnRepository $envRepository,
    ): DockerRepositoryRegistry {
        $accounts = \array_merge(
            $configRepository->all(),
            $envRepository->all(),
        );

        return new DockerRepositoryRegistry(
            \array_unique($accounts)
        );
    }

    public function initDockerClient(): ClientInterface
    {
        return new Client(
            new NativeHttpClient([
                'base_uri' => 'https://hub.docker.com/',
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ])
        );
    }
}
