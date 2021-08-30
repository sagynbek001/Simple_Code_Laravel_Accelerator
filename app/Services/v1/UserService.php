<?php

namespace App\Services\v1;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\UserRepository;

class UserService extends BaseService{

    private $repoUser;

    public function __construct(UserRepository $repoUser)
    {
        $this->repoUser = $repoUser;
    }

    public function getProfile($data): ServiceResult
    {
        return $data->user();
    }
}
