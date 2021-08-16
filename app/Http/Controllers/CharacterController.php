<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\CharacterCollection;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    private $CharacterService;

    public function __construct(CharacterService $CharacterService)
    {
        $this->CharacterService = $CharacterService;
    }

    public function index(Request $request)
    {
        $data = $this->CharacterService->index($request);
        return new CharacterCollection($data);
    }

    public function get($id, Request $request)
    {
        $data = $this->CharacterService->get($id, $request);
        return new CharacterResource($data);
    }

    public function store(CharacterRequest $request)
    {
        $this->CharacterService->store($request->validated());
        return ['message' => 'Персонаж сохранен'];
    }

    public function update($id, CharacterRequest $request)
    {
        $this->CharacterService->update($id, $request->validated());
        return ['message' => 'Персонаж сохранен'];
    }

    public function destroy($id)
    {
        $this->CharacterService->destroy($id);
        return ['message' => 'Персонаж удален'];
    }
}


