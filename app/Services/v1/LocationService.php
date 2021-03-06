<?php

namespace App\Services\v1;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\LocationRepository;
use App\Repositories\ImageRepository;
class LocationService extends BaseService
{
    private $repoLocation;

    public function __construct(LocationRepository $repoLocation)
    {
        $this->repoLocation = $repoLocation;
    }

    public function index(array $params): ServiceResult
    {
        return $this->result($this->repoLocation->index($params));
    }

    public function get($id): ServiceResult
    {
        $model = $this->repoLocation->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Локация не найдена');
        }
        return $this->result($model);
    }

    public function store($data): ServiceResult
    {
        if ($this->repoLocation->existsName($data['name'], 0)) {
            return $this->errValidate('Локация с таким именем уже существует');
        }
        $model = $this->repoLocation->store($data);
        return $this->ok('Локация сохранена');
    }

    public function update($id, $data): ServiceResult
    {
        $model = $this->repoLocation->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Локация не найдена');
        }
        if ($this->repoLocation->existsName($data['name'], $id)) {
            return $this->errValidate('Локация с таким именем уже существует');
        }
        $this->repoLocation->update($model, $data);
        return $this->ok('Локация сохранена');
    }

    public function destroy($id): ServiceResult
    {
        $model = $this->repoLocation->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Локация не найдена');
        }
        $this->repoLocation->destroy($model);
        return $this->ok('Локация удалена');
    }

    public function storeImage($id, $request): ServiceResult
    {
        $imageService = new ImageService(new ImageRepository());
        $model = $imageService->store($request);
        $this->repoLocation->storeImage($id, $model->id);
        return $this->ok('Картинка добавлена');
    }

    public function destroyImage($id): ServiceResult
    {
        $this->repoLocation->destroyImage($id);
        return $this->ok('Картинка удалена');
    }
}
