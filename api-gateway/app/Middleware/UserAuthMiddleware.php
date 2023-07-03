<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\ServiceException;
use App\Services\AuthService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserAuthMiddleware implements MiddlewareInterface
{

    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var HttpResponse
     */
    protected HttpResponse $response;

    /**
     * 注入AuthService
     * @var AuthService
     */
    #[Inject]
    protected AuthService $authService;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $this->getBearerToken($request);

        if (empty($token)) {
            throw new ServiceException(422, 'token不存在');
        }

        //调用authService.getRpcUserCheckToken方法
        $this->authService->getRpcUserCheckToken($token);

        return $handler->handle($request);

    }

    public function getBearerToken($request): ?string
    {
        $Authorization = $this->request->header('Authorization');

        return getBearerToken($Authorization);
    }
}
