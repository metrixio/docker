<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bootloader;
use Spiral\Boot\Bootloader\CoreBootloader;
use Spiral\Bootloader as Framework;
use Spiral\DotEnv\Bootloader as DotEnv;
use Spiral\Monolog\Bootloader as Monolog;
use Spiral\RoadRunnerBridge\Bootloader as RoadRunnerBridge;
use Spiral\Tokenizer\Bootloader\TokenizerBootloader;

class Kernel extends \Spiral\Framework\Kernel
{
    protected function defineSystemBootloaders(): array
    {
        return [
            CoreBootloader::class,
            TokenizerBootloader::class,
            DotEnv\DotenvBootloader::class,
        ];
    }

    /*
     * List of components and extensions to be automatically registered
     * within system container on application start.
     */
    protected function defineBootloaders(): array
    {
        return [
            Monolog\MonologBootloader::class,
            Bootloader\ExceptionHandlerBootloader::class,

            // RoadRunner
            RoadRunnerBridge\GRPCBootloader::class,
            RoadRunnerBridge\MetricsBootloader::class,
            RoadRunnerBridge\QueueBootloader::class,
            RoadRunnerBridge\LoggerBootloader::class,

            // Core Services
            Framework\SnapshotsBootloader::class,

            // Framework commands
            Framework\CommandBootloader::class,
            RoadRunnerBridge\CommandBootloader::class,
        ];
    }

    protected function defineAppBootloaders(): array
    {
        return [
            Bootloader\DockerBootloader::class,
        ];
    }
}
