<?php
/**
 * @user: DoubleJin
 * @date: 2022/5/24
 * @create: 09:31
 */

namespace App\JsonRpc;

use App\Services\OrderService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RpcServer\Annotation\RpcService;

/**
 * 订单rpc服务
 * Class OrderRpcService
 * @package App\JsonRpc
 */
#[RpcService(name: "OrderRpcService", server: "jsonrpc-http", protocol: "jsonrpc-http", publishTo: "nacos")]
class OrderRpcService implements OrderRpcServiceInterface
{
    /**
     * 注入OrderService
     * @var OrderService
     */
    #[Inject]
    protected OrderService $orderService;

    /**
     * 订单列表
     * @param int $userId
     * @return array
     */
    public function orderList(int $userId): array
    {
        return [
            'code' => 200,
            'data' => $this->orderService->orderList($userId)
        ];
    }

    /**
     * 创建订单
     * @param array $data
     * @return array
     */
    public function createOrder(array $data): array
    {
        return [
            'code' => 200,
            'data' => $this->orderService->createOrder($data)
        ];
    }

    /**
     * 投递订单消息到RabbitMQ
     * @return array
     */
    public function orderRabbitMQ(): array
    {
        $this->orderService->orderRabbitMQ();

        return [
            'code' => 200,
            'data' => ""
        ];
    }
}
