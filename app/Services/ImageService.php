<?php

namespace App\Services;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\ImageRepository;
class ImageService extends BaseService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new ImageRepository();
    }

    public function store($data): ServiceResult
    {
        $this->repo->store($data);
        return $this->ok('Картинка сохранена');
    }

    public function destroy($id): ServiceResult
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Картинка не найдена');
        }
        $this->repo->destroy($model);
        return $this->ok('Картинка удалена');
    }
}
