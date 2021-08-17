<?php

namespace App\Services;

use App\Repositories\CharacterRepository;
class CharacterService
{
    private $repo;

    public function __construct(CharacterRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index($request)
    {
        return $this->repo->index($request);
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function store($request)
    {
        $this->repo->store($request);
        return ['message' => 'Персонаж сохранен'];
    }

    public function update($id, $request)
    {
        $this->repo->update($id, $request);
        return ['message' => 'Персонаж сохранен'];
    }

    public function destroy($id)
    {
        $this->repo->destroy($id);
        return ['message' => 'Персонаж удален'];
    }
}
