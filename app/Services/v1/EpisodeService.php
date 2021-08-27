<?php

namespace App\Services\v1;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\EpisodeRepository;
class EpisodeService extends BaseService
{
    private $repoEpisode;

    public function __construct(EpisodeRepository $repoEpisode)
    {
        $this->repoEpisode = $repoEpisode;
    }

    public function index(array $params): ServiceResult
    {
        return $this->result($this->repoEpisode->index($params));
    }

    public function get($id): ServiceResult
    {
        $model = $this->repoEpisode->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        return $this->result($model);
    }

    public function getCharacters($id, array $params): ServiceResult
    {
        $model = $this->repoEpisode->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        return $this->result($this->repoEpisode->getCharacters($model, $params));
    }

    public function store($data): ServiceResult
    {
        if ($this->repoEpisode->existsName($data['name'], 0)) {
            return $this->errValidate('Эпизод с таким именем уже существует');
        }
        $model = $this->repoEpisode->store($data);
        return $this->ok($model, 'Эпизод сохранен');
    }

    public function update($id, $data): ServiceResult
    {
        $model = $this->repoEpisode->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        if ($this->repoEpisode->existsName($data['name'], $id)) {
            return $this->errValidate('Эпизод с таким именем уже существует');
        }
        $this->repoEpisode->update($model, $data);
        return $this->ok('Эпизод сохранен');
    }

    public function destroy($id): ServiceResult
    {
        $model = $this->repoEpisode->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        $this->repoEpisode->destroy($model);
        return $this->ok('Эпизод удален');
    }
}
