<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use Illuminate\Http\Request;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\CharacterCollection;
class CharacterController extends Controller
{
    private $CharacterService;

    public function __construct(CharacterService $CharacterService)
    {
        $this->CharacterService = $CharacterService;
    }

    public function index(Request $request)
    {
        $data = $this->CharacterService->index($request->all());
        return new CharacterCollection($data);
    }

    public function get($id, Request $request)
    {
        $data = $this->CharacterService->get($id, $request);
        return new CharacterResource($data);
    }

    public function store(CharacterRequest $request)
    {
        $data = $this->CharacterService->store($request->validated());
        return $data;
    }

    public function update($id, CharacterRequest $request)
    {
        $data = $this->CharacterService->update($id, $request->validated());
        return $data;
    }

    public function destroy($id)
    {
        $data = $this->CharacterService->destroy($id);
        return $data;
    }
}


