<?php

declare(strict_types=1);

use Spiral\RoadRunner\Jobs\Queue\MemoryCreateInfo;
use Spiral\RoadRunnerBridge\Queue\Queue;

return [
    'default' => env('QUEUE_DRIVER', 'roadrunner'),
    'aliases' => [],
    'connections' => [
        'roadrunner' => [
            'driver' => 'roadrunner',
            'default' => env('QUEUE_PIPELINE', 'memory'),
            'pipelines' => [
                'memory' => [
                    'connector' => new MemoryCreateInfo('local'),
                    'consume' => true,
                ],
            ],
        ],
    ],

    'registry' => [
        'handlers' => [],
    ],

    'interceptors' => [
        'push' => [],
        'consume' => [
            \Spiral\Queue\Interceptor\Consume\ErrorHandlerInterceptor::class,
        ],
    ],
];
