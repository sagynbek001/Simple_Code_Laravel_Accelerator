<?php

namespace App\Services\v1;

use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\EpisodeRepository;
use App\Repositories\ImageRepository;
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
        return $this->ok('Эпизод сохранен');
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

    public function storeImage($id, $request): ServiceResult
    {
        $imageService = new ImageService(new ImageRepository());
        $model = $imageService->store($request);
        $this->repoEpisode->storeImage($id, $model->id);
        return $this->ok('Картинка добавлена');
    }

    public function destroyImage($id): ServiceResult
    {
        $this->repoEpisode->destroyImage($id);
        return $this->ok('Картинка удалена');
    }

    public function attachCharacter($episode_id, $character_id): ServiceResult
    {
        $episode = $this->repoEpisode->get($episode_id);
        if (is_null($episode)){
            return $this->errNotFound('Эпизод не найден');
        }

        if ($this->repoEpisode->existsCharacter($episode, $character_id)){
            return $this->errValidate('Этот персонаж уже есть в этом эпизоде');
        }

        $this->repoEpisode->attachCharacter($episode, $character_id);
        return $this->ok('Персонаж добавлен к эпизоду');
    }

    public function dettachCharacter($episode_id, $character_id): ServiceResult
    {
        $episode = $this->repoEpisode->get($episode_id);
        if (is_null($episode)){
            return $this->errNotFound('Эпизод не найден');
        }
        if (!$this->repoEpisode->existsCharacter($episode, $character_id)){
            return $this->errValidate('Этого персонажа нет в этом эпизоде');
        }

        $this->repoEpisode->dettachCharacter($episode, $character_id);
        return $this->ok('Персонаж удален из эпизода');
    }
}
