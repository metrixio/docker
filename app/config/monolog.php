<?php

declare(strict_types=1);

use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

return [
    'default' => 'roadrunner',
    'globalLevel' => Logger::toMonologLevel(env('MONOLOG_DEFAULT_LEVEL', Logger::DEBUG)),
    'handlers' => [
        'roadrunner' => [
            \Spiral\RoadRunnerBridge\Logger\Handler::class,
        ]
    ],
];
