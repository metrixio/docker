<?php

declare(strict_types=1);

namespace App\Infrastructure\Docker\DTO;

final class Repository
{
    public function __construct(
        public readonly string $name,
        public readonly int $downloads,
        public readonly int $stars,
        public readonly int $collaborators,
    ) {
    }
}
