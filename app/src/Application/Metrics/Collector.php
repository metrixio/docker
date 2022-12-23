<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\Goridge\RPC\Exception\ServiceException;
use Spiral\Goridge\RPC\RPCInterface;
use Spiral\RoadRunner\Metrics\MetricsInterface;

final class Collector
{
    public function __construct(
        private readonly MetricsInterface $metrics,
        private RPCInterface $rpc
    ) {
        $this->rpc = $this->rpc->withServicePrefix('metrics');
    }

    public function declare(CollectorsInterface $collectors): self
    {
        foreach ($collectors as $name => $collector) {
            try {
                $this->rpc->call('Unregister', $name);
            } catch (ServiceException $e) {
            }

            $this->metrics->declare($name, $collector);
        }

        return $this;
    }
}
