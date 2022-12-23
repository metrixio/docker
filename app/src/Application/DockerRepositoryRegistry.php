<?php

declare(strict_types=1);

namespace App\Application;

/**
 * @psalm-type TRepository = string
 */
final class DockerRepositoryRegistry
{
    /**
     * @param TRepository[] $repositories
     */
    public function __construct(
        private array $repositories = []
    ) {
    }

    /**
     * @param TRepository $repository
     */
    public function add(string $repository): void
    {
        $this->repositories[] = $repository;
    }

    /**
     * @param TRepository $repository
     */
    public function remove(string $repository): void
    {
        $this->repositories = \array_filter(
            $this->repositories,
            static fn(string $item): bool => $item !== $repository
        );
    }

    /**
     * @return TRepository[]
     */
    public function getRepositories(): array
    {
        return $this->repositories;
    }
}
