<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
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

    public function get($id): ServiceResult
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Картинка не найден');
        }
        return $this->result($model);
    }

    public function store($request) //: ServiceResult
    {
        $path = $request->file('file')->storePublicly('images', 'public');
        $model = $this->repo->store(['path'=>$path]);
        return $model;
    }

    public function destroy($id): ServiceResult
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Картинка не найдена');
        }
        Storage::delete(str_replace("images/", "", $model->path));
        $this->repo->destroy($model);
        return $this->ok('Картинка удалена');
    }
}
