<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\UserService;
use Hyperf\CircuitBreaker\Annotation\CircuitBreaker;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 服务降级控制器
 * Class CircuitBreakerController
 * @package App\Controller
 */
#[Controller(prefix: '/circuit-breaker')]
class CircuitBreakerController extends CommonController
{

    /**
     * 注入UserService
     * @var UserService
     */
    #[Inject]
    protected UserService $userService;

    /**
     * 测试服务降级
     * @return ResponseInterface
     */
    #[GetMapping(path: 'test')]
    #[CircuitBreaker(options: ["timeout" => 0.05], failCounter: 1, successCounter: 1, fallback: "App\Controller\CircuitBreakerController::circuitBreakerFallback")]
    public function test(): ResponseInterface
    {
        $this->userService->testCircuitBreaker();

        return $this->success('这是服务降级.');
    }

    /**
     * 服务降级异常返回方法
     * @return ResponseInterface
     */
    public function circuitBreakerFallback(): ResponseInterface
    {
        return $this->success('服务降级啦~');
    }

}
