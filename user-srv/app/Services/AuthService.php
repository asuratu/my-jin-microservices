<?php


namespace App\Services;

use App\Exception\JsonRpcException;
use App\Log;
use App\Model\User;
use App\Repositories\UserRepository;
use Hyperf\Di\Annotation\Inject;
use Qbhy\HyperfAuth\Authenticatable;
use Qbhy\HyperfAuth\AuthManager;
use Throwable;

/**
 * 用户service
 * Class AuthService
 * @package App\Services
 */
class AuthService
{

    #[Inject]
    protected AuthManager $auth;

    /**
     * @Inject
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * 用户登录
     * @param $phone
     * @return array
     */
    public function userLogin($phone): array
    {
        Log::get()->info("调用userLogin");

        $user = User::query()
            ->withSum('bonus', 'bonus')
            ->withSum('stored', 'amount')
            ->where('phone', $phone)
            ->first();

        // 模型缓存
//        $demo = User::findFromCache(1);
//
//        Log::get()->info("demo", [$demo]);

        if (empty($user) || !$user instanceof Authenticatable) {
            Log::get()->info("用户不存在");

            throw new JsonRpcException(10001);
        }

        return [
            'user_info' => $user,
            'token_type' => 'bearer_token',
            'token' => $this->auth->guard('jwt')->login($user),
        ];
    }

    /**
     * 用户退出
     * @param $token
     * @return void
     */
    public function userLogout($token): void
    {
        Log::get()->info("调用userLogout");

        $this->auth->guard('jwt')->logout($token);
    }

    /**
     * 检查用户token
     * @param $token
     * @return void
     */
    public function userCheckToken($token): void
    {
        Log::get()->info("调用userCheckToken");

        $guard = $this->auth->guard('jwt');

        try {

            if (!$guard->user($token) instanceof Authenticatable) {
                throw new JsonRpcException(422);
            }

        } catch (Throwable $exception) {
            throw new JsonRpcException(422);
        }
    }

    public function getUserById($id): User
    {
        return $this->userRepository->findUserById($id);
    }
}
