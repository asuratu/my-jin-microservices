<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 */

use App\Constants\ResponseCode;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * 获取Container
 */
if (!function_exists('di')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @param mixed|null $id
     * @return mixed|ContainerInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function di(mixed $id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }
        return $container;
    }
}

/**
 * 控制台日志
 */
if (!function_exists('stdLog')) {
    function stdLog()
    {
        return di()->get(StdoutLoggerInterface::class);
    }
}

/**
 * 文件日志
 */
if (!function_exists('logger')) {
    function logger($name = 'log', $group = 'default')
    {
        return di()->get(LoggerFactory::class)->get($name, $group);
    }
}

/**
 * redis 客户端实例
 */
if (!function_exists('redis')) {
    function redis()
    {
        return di()->get(Redis::class);
    }
}

/**
 * 缓存实例 简单的缓存
 */
if (!function_exists('cache')) {
    function cache()
    {
        return di()->get(CacheInterface::class);
    }
}

if (!function_exists('format_throwable')) {
    /**
     * Format a throwable to string.
     * @param Throwable $throwable
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function format_throwable(Throwable $throwable): string
    {
        return di()->get(FormatterInterface::class)->format($throwable);
    }
}


if (!function_exists('responseSuccess')) {
    function responseSuccess($code, $message = '', $data = []): array
    {
        $content = ['code' => $code];
        $message ? $content['msg'] = $message : $content['msg'] = ResponseCode::getMessage($code);
        $data ? $content['data'] = $data : $content['data'] = [];
        return $content;
    }
}

if (!function_exists('responseError')) {
    function responseError($code, $message = '', $data = []): array
    {
        $content = ['code' => $code];
        $data ? $content['data'] = $data : $content['data'] = [];
        return $content;
    }
}


/**
 * 判读字符串是否为json
 */
if (!function_exists('isJson')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @param string $string
     */
    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}


/**
 * 返回jsonRpc结构
 */
if (!function_exists('successJsonRpc')) {
    function successJsonRpc($code, $data)
    {
        return [
            'code' => $code,
            'data' => $data
        ];
    }
}
