<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Http\Requests\CharacterCreateRequest;
use App\Http\Requests\CharacterUpdateRequest;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::select('name','status','gender','race','description')->get();
        return response()->json($characters, 200);
    }

    public function show($id)
    {
        $character = Character::select('name','status','gender','race','description')->where('id', $id)->get();
        return response()->json($character, 200);
    }

    public function store(CharacterCreateRequest $request)
    {
        Character::create($request->validated());
        return ['message' => 'Персонаж сохранен'];
    }

    public function update($id, CharacterUpdateRequest $request)
    {
        Character::where('id', $id)->update($request->validated());
        return ['message' => 'Персонаж сохранен'];
    }

    public function destroy($id)
    {
        $character = $this->characterModel::find($id);
        $character->delete();
        return ['message' => 'Персонаж удален'];
    }
}


