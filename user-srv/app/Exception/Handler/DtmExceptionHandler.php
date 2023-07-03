<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Exception\ServiceException;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * DTM异常处理
 * Class JsonRpcExceptionHandler
 * @package App\Exception\Handler
 */
class DtmExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected StdoutLoggerInterface $logger;

    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {

        if ($throwable instanceof ServiceException) {

            //阻止异常冒泡
            $this->stopPropagation();

            return $response->withStatus(409);
        }

        // 交给下一个异常处理器
        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
