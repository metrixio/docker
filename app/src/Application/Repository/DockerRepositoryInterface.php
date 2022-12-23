<?php

declare(strict_types=1);

namespace App\Application\Repository;

interface DockerRepositoryInterface
{
    public function all(): array;
}
