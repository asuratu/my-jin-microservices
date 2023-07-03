<?php
/**
 * @user: DoubleJin
 * @date: 2022/5/24
 * @create: 09:31
 */

namespace App\JsonRpc;

use App\Services\FileService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RpcServer\Annotation\RpcService;

/**
 * 文件rpc服务
 * Class OrderRpcService
 * @package App\JsonRpc
 */
#[RpcService(name: "FileRpcService", server: "jsonrpc-http", protocol: "jsonrpc-http", publishTo: "nacos")]
class FileRpcService implements FileRpcServiceInterface
{
    #[Inject]
    protected FileService $fileService;

    /**
     * 上传文件
     * @param string $type
     * @param string $base64string
     * @param string $fileName
     * @return array
     */
    public function uploadFile(string $type, string $base64string, string $fileName): array
    {
        return [
            'code' => 200,
            'data' => $this->fileService->uploadFile($type, $base64string, $fileName)
        ];
    }

}
