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
        return $this->repo->store($request);
    }

    public function update($id, $request)
    {
        return $this->repo->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }
}
