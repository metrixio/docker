<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\RoadRunner\Metrics\Collector;

final class DockerCollectors implements CollectorsInterface
{
    public const DOWNLOADS = 'docker_downloads';
    public const STARS = 'docker_stars';
    public const COLLABORATORS = 'docker_collaborators';

    public function getIterator(): \Traversable
    {
        yield self::DOWNLOADS => Collector::gauge()
            ->withHelp('Docker downloads statistics.')
            ->withLabels('repo');

        yield self::STARS => Collector::gauge()
            ->withHelp('Docker stars statistics.')
            ->withLabels('repo');

        yield self::COLLABORATORS => Collector::gauge()
            ->withHelp('Docker collaborators statistics.')
            ->withLabels('repo');
    }
}
