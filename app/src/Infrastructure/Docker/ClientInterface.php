<?php

declare(strict_types=1);

namespace App\Infrastructure\Docker;

use App\Infrastructure\Docker\DTO\Repository;

interface ClientInterface
{
    public function getRepository(string $name): Repository;
}
