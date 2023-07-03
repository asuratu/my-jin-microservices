<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * 配置控制器
 * Class ConfigController
 * @package App\Controller
 */
#[Controller(prefix: '/config')]
class ConfigController extends CommonController
{

    /**
     * 测试配置中心数据获取
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    #[GetMapping(path: 'test')]
    public function test(RequestInterface $request): ResponseInterface
    {
        //获取 nacos 中的配置
        $config = config('nacos_config');

        return $this->success($config);
    }

}
