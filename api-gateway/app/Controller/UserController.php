<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * 用户控制器
 * Class UserController
 * @package App\Controller
 */
#[Controller(prefix: '/user')]
class UserController extends CommonController
{
    /**
     * 注入UserService
     * @var UserService
     */
    #[Inject]
    protected UserService $userService;

    /**
     * 用户信息
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    #[GetMapping(path: 'UserInfo')]
    public function userInfo(RequestInterface $request): ResponseInterface
    {
        //调用userService.getRpcUserInfo方法
        $res = $this->userService->getRpcUserInfo(1);

        return $this->success($res);
    }

    /**
     * 用户积分列表
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    #[GetMapping(path: 'UserBonusList')]
    public function userBonusList(RequestInterface $request): ResponseInterface
    {
        //调用userService.getRpcUserBonusList方法
        $res = $this->userService->getRpcUserBonusList(1, 15);

        return $this->success($res);
    }

    /**
     * 用户储值列表
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    #[GetMapping(path: 'UserStoredList')]
    public function userStoredList(RequestInterface $request): ResponseInterface
    {
        //调用userService.getRpcUserStoredList方法
        $res = $this->userService->getRpcUserStoredList(1, 15);

        return $this->success($res);
    }

    /**
     * 投递用户消息到RabbitMQ
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    #[GetMapping(path: 'UserRabbitMQ')]
    public function userRabbitMQ(RequestInterface $request): ResponseInterface
    {
        //调用userService.getRpcUserStoredList方法
        $res = $this->userService->getRpcUserRabbitMQ();

        return $this->success($res);
    }
}
