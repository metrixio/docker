<?php

declare(strict_types=1);

namespace App\Application\Job;

use App\Application\Metrics\DockerMetrics;
use App\Infrastructure\Docker\ClientInterface;
use Psr\Log\LoggerInterface;
use Spiral\Exceptions\ExceptionReporterInterface;
use Spiral\Queue\Exception\RetryException;
use Spiral\Queue\JobHandler;
use Spiral\Queue\Options;

final class DockerDataCollector extends JobHandler
{
    /**
     * @throws RetryException
     */
    public function invoke(
        DockerMetrics $metrics,
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

            $metrics->setDownloadsCount((float)$repository->downloads, $repo);
            $metrics->setStarsCount((float)$repository->stars, $repo);
            $metrics->setCollaboratorsCount((float)$repository->stars, $repo);
        } catch (\Throwable $e) {
            $reporter->report($e);

            throw new RetryException(
                reason: $e->getMessage(),
                options: (new Options())->withDelay(5)->withHeader('attempts', (string)($attempts - 1))
            );
        }
    }
}
