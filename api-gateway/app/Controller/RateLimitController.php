<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\RateLimit\Annotation\RateLimit;
use Psr\Http\Message\ResponseInterface;

/**
 * 限流控制器
 * Class RateLimitController
 * @package App\Controller
 */
#[Controller(prefix: '/rate-limit')]
class RateLimitController extends CommonController
{

    /**
     * 测试限流
     * @return ResponseInterface
     */
    #[GetMapping(path: 'test')]
    #[RateLimit(create: 1, consume: 1, capacity: 1, waitTimeout: 1)]
    // create: 1 表示每秒创建一个令牌
        // consume: 1 表示每次请求消耗一个令牌
        // capacity: 1 表示令牌桶的容量为 1
        // waitTimeout: 1 表示如果令牌桶中没有令牌，等待 1 秒
    public function test(): ResponseInterface
    {
        return $this->success('这是测试限流');
    }

}
