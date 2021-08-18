<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use Illuminate\Http\Request;
use App\Http\Requests\CharacterIndexRequest;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterResource;
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
        $result = $this->CharacterService->index($request->all());
        return $this->resultCollection(CharacterCollection::class, $result);
    }

    public function get($id, Request $request)
    {
        $data = $this->CharacterService->get($id, $request);
        return new CharacterResource($data);
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


