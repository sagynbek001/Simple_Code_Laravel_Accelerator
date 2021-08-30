<?php

namespace App\Services\v1;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService{

    private $repoUser;

    public function __construct(UserRepository $repoUser)
    {
        $this->repoUser = $repoUser;
    }

    public function register(array $data): ServiceResult
    {
        $model = $this->repoUser->register($data);
        return $this->ok('Пользователь зарегистрирован');
    }

    public function login(array $data): ServiceResult
    {
        $credentials = array(
            'phone' => $data['phone'],
            'password' => $data['password']
        );

        if (!Auth::attempt($credentials)) {
            return $this->errValidate('Неверные данные');
        }

        $model = $this->repoUser->get($data['phone']);

        $token = $model->createToken($data['device_name'])->plainTextToken;

        $tokenArr = array("token" => $token);

        return $this->result([
            'token' => $token,
            'userId' => $model->id,
            'userName' => $model->name,
        ]);
    }

    public function logout($phone): ServiceResult
    {
        $user = $this->repoUser->get($phone);
        $user->currentAccessToken()->delete();
        return $this->ok('Пользователь разлогинен');
    }
}
