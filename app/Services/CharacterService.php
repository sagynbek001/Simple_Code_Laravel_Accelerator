<?php

namespace App\Services;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\CharacterRepository;
class CharacterService extends BaseService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new CharacterRepository();
    }

    public function index($params): ServiceResult
    {
        return $this->result($this->repo->index($params));
    }

    public function get($id): ServiceResult
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        return $this->result($model);
    }

    public function store($data): ServiceResult
    {
        if ($this->repo->existsName($data['name'], 0)) {
            return $this->errValidate('Персонаж с таким именем уже существует');
        }
        $this->repo->store($data);
        return $this->ok('Персонаж сохранен');
    }

    public function update($id, $data): ServiceResult
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        if ($this->repo->existsName($data['name'], $id)) {
            return $this->errValidate('Персонаж с таким именем уже существует');
        }
        $this->repo->update($model, $data);
        return $this->ok('Персонаж сохранен');
    }

    public function destroy($id): ServiceResult
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        $this->repo->destroy($model);
        return ['message' => 'Персонаж удален'];
    }
}
