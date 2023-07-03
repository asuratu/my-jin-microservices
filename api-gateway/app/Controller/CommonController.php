<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * 通用控制器
 * Class CommonController
 * @package App\Controller
 */
class CommonController extends AbstractController
{
    public function success($data = []): ResponseInterface
    {
        return $this->response->json(responseSuccess(200, '', $data));
    }

}
