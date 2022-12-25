<?php

declare(strict_types=1);

namespace App\Api\Cli;

use App\Application\DockerRepositoryRegistry;
use App\Application\Job\DockerDataCollector;
use App\Application\Metrics\Collector;
use App\Application\Metrics\DockerCollectors;
use Psr\Log\LoggerInterface;
use Spiral\Console\Command;
use Spiral\Queue\Options;
use Spiral\Queue\QueueInterface;

final class CollectMetrics extends Command
{
    protected const SIGNATURE = <<<CMD
        collect:start
        {--i|interval=300 : Interval in seconds}
    CMD;

    protected const DESCRIPTION = 'Collect twitter metrics';

    public function __invoke(
        LoggerInterface $logger,
        DockerRepositoryRegistry $registry,
        Collector $metrics,
        QueueInterface $queue,
    ): int {
        $interval = $this->getInterval();

        while (true) {
            $metrics->declare(new DockerCollectors());

            foreach ($registry->getRepositories() as $repository) {
                $logger->debug('Collecting metrics', ['repository' => $repository]);

                $queue->push(
                    DockerDataCollector::class,
                    ['repository' => $repository],
                    (new Options())->withHeader('attempts', '5')
                );
            }

            \sleep($interval);
        }

        return self::SUCCESS;
    }

    public function getInterval(): int
    {
        return \max(
            (int)$this->option('interval'),
            10
        );
    }
}
