<?php

namespace App\Services;

use App\Http\Requests\CharacterRequest;
use App\Repositories\CharacterRepository;
use Illuminate\Http\Request;

class CharacterService
{
    private $repo;

    public function __construct(CharacterRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        return $this->repo->index($request);
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function store(CharacterRequest $request)
    {
        return $this->repo->store($request);
    }

    public function update($id, CharacterRequest $request)
    {
        return $this->repo->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }
}
