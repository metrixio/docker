<?php

declare(strict_types=1);

use App\Application\GRPC\Interceptor\ExceptionHandlerInterceptor;

return [
    'binaryPath' => directory('root') . 'protoc-gen-php-grpc',

    'generatedPath' => directory('root'),

    'namespace' => '\GRPC',

    'servicesBasePath' => directory('root') . '/proto',

    'services' => [
        directory('root') . 'proto/message.proto',
        directory('root') . 'proto/service.proto',
    ],

    'interceptors' => [
        ExceptionHandlerInterceptor::class,
    ],
];
