<?php

declare(strict_types=1);

namespace App\Infrastructure\Docker;

use App\Infrastructure\Docker\DTO\Repository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class Client implements ClientInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function getRepository(string $name): Repository
    {
        $response = $this->httpClient->request('GET', "/v2/repositories/{$name}");

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException(\sprintf('Docker repository [%s] something went wrong', $name));
        }

        $data = \json_decode($response->getContent(), true);
        return new Repository(
            name: $name,
            downloads: $data['pull_count'],
            stars: $data['star_count'],
            collaborators: $data['collaborator_count'],
        );
    }
}
