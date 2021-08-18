<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use App\Http\Requests\CharacterIndexRequest;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterCollection;
class CharacterController extends Controller
{
    private $CharacterService;

    public function __construct()
    {
        $this->CharacterService = new CharacterService();
    }

    public function index(CharacterIndexRequest $request)
    {
        $result = $this->CharacterService->index($request->validated());
        return $this->resultCollection(CharacterCollection::class, $result);
    }

    public function get($id)
    {
        return $this->result($this->CharacterService->get($id));
    }

    public function store(CharacterRequest $request)
    {
        return $this->result($this->CharacterService->store($request->validated()));
    }

    public function update($id, CharacterRequest $request)
    {
        return $this->result($this->CharacterService->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        return $this->result($this->CharacterService->destroy($id));
    }
}


