<?php

declare(strict_types=1);

namespace App\Application\Job;

use App\Infrastructure\Docker\ClientInterface;
use Psr\Log\LoggerInterface;
use Spiral\Exceptions\ExceptionReporterInterface;
use Spiral\Queue\Exception\RetryException;
use Spiral\Queue\JobHandler;
use Spiral\Queue\Options;
use Spiral\RoadRunner\Metrics\MetricsInterface;

final class DockerDataCollector extends JobHandler
{
    /**
     * @throws RetryException
     */
    public function invoke(
        MetricsInterface $metrics,
        LoggerInterface $logger,
        ClientInterface $client,
        ExceptionReporterInterface $reporter,
        array $payload,
        array $headers = []
    ): void {
        $repo = $payload['repository'];

        $attempts = (int)($headers['attempts'] ?? 0);

        if ($attempts === 0) {
            $logger->warning('Attempt to fetch [%s] docker data failed', $repo);
            return;
        }

        try {
            $repository = $client->getRepository($repo);

            $metrics->set('docker_downloads', (float)$repository->downloads, [$repo]);
            $metrics->set('docker_stars', (float)$repository->stars, [$repo]);
            $metrics->set('docker_collaborators', (float)$repository->collaborators, [$repo]);
        } catch (\Throwable $e) {
            $reporter->report($e);

            throw new RetryException(
                reason: $e->getMessage(),
                options: (new Options())->withDelay(5)->withHeader('attempts', (string)($attempts - 1))
            );
        }
    }
}
