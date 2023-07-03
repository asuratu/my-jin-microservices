<?php


namespace App\Services;

use App\Exception\ServiceException;
use App\JsonRpc\OrderRpcServiceInterface;
use App\Log;
use Hyperf\Di\Annotation\Inject;
use Throwable;

/**
 * 订单service
 * Class OrderService
 * @package App\Services
 */
class OrderService
{

    /**
     * 注入OrderRpcServiceInterface
     * @var OrderRpcServiceInterface
     */
    #[Inject]
    protected OrderRpcServiceInterface $orderRpcServiceInterface;

    /**
     * 订单列表
     * @param int $userId
     * @return mixed
     */
    public function getRpcOrderList(int $userId): mixed
    {
        Log::get()->info("调用getRpcOrderList");

        try {
            //调用订单服务中的订单列表方法
            $res = $this->orderRpcServiceInterface->orderList($userId);

        } catch (Throwable $ex) {
            Log::get()->info("rpc调用失败", [
                'code' => $ex->getCode(),
                'file' => $ex->getFile(),
                'message' => $ex->getMessage(),
            ]);

            throw new ServiceException(430);
        }

        if ($res['code'] !== 200) {
            Log::get()->info("rpc调用失败", [
                'code' => $res['code'],
                'file' => '',
                'message' => $res['message']
            ]);

            throw new ServiceException(430);
        }

        return $res['data'];
    }

    /**
     * 创建列表
     * @param array $data
     * @return mixed
     */
    public function rpcCreateOrder(array $data): mixed
    {
        Log::get()->info("调用rpcCreateOrder");

        try {
            //调用订单服务中的创建订单方法
            $res = $this->orderRpcServiceInterface->createOrder($data);

        } catch (Throwable $ex) {

            Log::get()->info("rpc调用失败", [
                'code' => $ex->getCode(),
                'file' => $ex->getFile(),
                'message' => $ex->getMessage(),
            ]);

            throw new ServiceException(430);
        }

        if ($res['code'] !== 200) {
            Log::get()->info("rpc调用失败", [
                'code' => $res['code'],
                'file' => '',
                'message' => $res['message']
            ]);

            throw new ServiceException(430);
        }

        return $res['data'];
    }

    /**
     * 投递用户消息到RabbitMQ
     * @return mixed
     */
    public function getRpcOrderRabbitMQ(): mixed
    {
        Log::get()->info("调用getRpcUserRabbitMQ");

        try {
            //调用订单服务中的投递订单消息到RabbitMQ方法
            $res = $this->orderRpcServiceInterface->orderRabbitMQ();

        } catch (Throwable $ex) {
            Log::get()->info("rpc调用失败", [
                'code' => $ex->getCode(),
                'file' => $ex->getFile(),
                'message' => $ex->getMessage(),
            ]);

            throw new ServiceException(430);
        }

        if ($res['code'] !== 200) {
            Log::get()->info("rpc调用失败", [
                'code' => $res['code'],
                'file' => '',
                'message' => $res['message']
            ]);

            throw new ServiceException(430);
        }

        return $res['data'];
    }

}
