<?php

declare(strict_types=1);

use Hyperf\Tracer\Middleware\TraceMiddleware;

return [
    'http' => [
        TraceMiddleware::class,
//        \App\Exception\Handler\AppServiceExceptionHandler::class,
    ],
    'jsonrpc-http' => [
        TraceMiddleware::class,
    ],
];
