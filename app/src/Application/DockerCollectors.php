<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Metrics\CollectorsInterface;
use Spiral\RoadRunner\Metrics\Collector;

final class DockerCollectors implements CollectorsInterface
{
    public function getIterator(): \Traversable
    {
        yield 'docker_downloads' => Collector::gauge()
            ->withHelp('Docker downloads statistics.')
            ->withLabels('repo');

        yield 'docker_stars' => Collector::gauge()
            ->withHelp('Docker stars statistics.')
            ->withLabels('repo');

        yield 'docker_collaborators' => Collector::gauge()
            ->withHelp('Docker collaborators statistics.')
            ->withLabels('repo');
    }
}
