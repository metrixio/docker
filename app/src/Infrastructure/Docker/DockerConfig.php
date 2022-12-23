<?php

declare(strict_types=1);

namespace App\Infrastructure\Docker;

use Spiral\Core\InjectableConfig;

final class DockerConfig extends InjectableConfig
{
    public const CONFIG = 'docker';

    public function __construct(
        protected array $config = [
            'repositories' => [],
        ]
    ) {
    }

    public function getRepositories(): array
    {
        return $this->config['repositories'] ?? [];
    }
}

