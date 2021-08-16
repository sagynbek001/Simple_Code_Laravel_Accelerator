<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Services\CharacterService;
use App\Http\Requests\CharacterRequest;
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
        return response()->json($data, 200);
    }

    public function get($id, Request $request)
    {
        $data = $this->CharacterService->get($id, $request);
        return response()->json($data, 200);
    }

    public function store(CharacterRequest $request)
    {
        $request->validated();
        $this->CharacterService->store($request);
        return ['message' => 'Персонаж сохранен'];
    }

    public function update($id, CharacterRequest $request)
    {
        $request->validated();
        $this->CharacterService->update($id, $request);
        return ['message' => 'Персонаж сохранен'];
    }

    public function destroy($id)
    {
        $this->CharacterService->destroy($id);
        return ['message' => 'Персонаж удален'];
    }
}


