<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\RoadRunner\Metrics\CollectorInterface;

interface CollectorsInterface extends \IteratorAggregate
{
    /**
     * @return \Traversable<string, CollectorInterface>
     */
    public function getIterator(): \Traversable;
}
