<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Infrastructure\Docker\DockerConfig;

final class DockerConfigRepository implements DockerRepositoryInterface
{
    public function __construct(
        private readonly DockerConfig $config,
    ) {
    }

    public function all(): array
    {
        return $this->config->getRepositories();
    }
}
