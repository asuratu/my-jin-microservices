<?php

declare(strict_types=1);

use DtmClient\Middleware\DtmMiddleware;
use Hyperf\Tracer\Middleware\TraceMiddleware;

return [
    'http' => [
        DtmMiddleware::class,
    ],
    'jsonrpc-http' => [
        TraceMiddleware::class,
        DtmMiddleware::class,
    ],
];
