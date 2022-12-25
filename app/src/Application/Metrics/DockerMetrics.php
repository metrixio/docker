<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\RoadRunner\Metrics\MetricsInterface;

final class DockerMetrics
{
    public function __construct(
        private readonly MetricsInterface $metrics
    ) {
    }

    public function setDownloadsCount(float $count, mixed $repo): void
    {
        $this->metrics->set(DockerCollectors::DOWNLOADS, $count, [$repo]);
    }

    public function setStarsCount(float $count, mixed $repo): void
    {
        $this->metrics->set(DockerCollectors::STARS, $count, [$repo]);
    }

    public function setCollaboratorsCount(float $count, mixed $repo): void
    {
        $this->metrics->set(DockerCollectors::COLLABORATORS, $count, [$repo]);
    }


}
