<?php

namespace App\Services\v1;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\CharacterRepository;
class CharacterService extends BaseService
{
    private $repoCharacter;

    public function __construct(CharacterRepository $repoCharacter)
    {
        $this->repoCharacter = $repoCharacter;
    }

    public function index(array $params): ServiceResult
    {
        return $this->result($this->repoCharacter->index($params));
    }

    public function get($id): ServiceResult
    {
        $model = $this->repoCharacter->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        return $this->result($model);
    }

    public function getEpisodes($id, array $params): ServiceResult
    {
        $model = $this->repoCharacter->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        return $this->result($this->repoCharacter->getEpisodes($model, $params));
    }

    public function store($data): ServiceResult
    {
        if ($this->repoCharacter->existsName($data['name'], 0)) {
            return $this->errValidate('Персонаж с таким именем уже существует');
        }
        $model = $this->repoCharacter->store($data);
        return $this->ok($model, 'Персонаж сохранен');
    }

    public function update($id, $data): ServiceResult
    {
        $model = $this->repoCharacter->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        if ($this->repoCharacter->existsName($data['name'], $id)) {
            return $this->errValidate('Персонаж с таким именем уже существует');
        }
        $this->repoCharacter->update($model, $data);
        return $this->ok('Персонаж сохранен');
    }

    public function destroy($id): ServiceResult
    {
        $model = $this->repoCharacter->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        $this->repoCharacter->destroy($model);
        return $this->ok('Персонаж удален');
    }

    public function storeImage($data): ServiceResult
    {
        if ($this->repoCharacter->existsName($data['name'], 0)) {
            return $this->errValidate('Персонаж с таким именем уже существует');
        }
        $model = $this->repoCharacter->store($data);
        return $this->ok($model, 'Персонаж сохранен');
    }

    public function destroyImage($id): ServiceResult
    {
        $model = $this->repoCharacter->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        $this->repoCharacter->destroy($model);
        return $this->ok('Персонаж удален');
    }
}
