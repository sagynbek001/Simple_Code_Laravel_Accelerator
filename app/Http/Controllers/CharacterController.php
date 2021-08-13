<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    protected $characterModel;

    public function __construct(Character $characterModel)
    {
        $this->characterModel = $characterModel;
    }

    public function list()
    {
        $characters = $this->characterModel::select('name','status','gender','race','description')->get();
        return response()->json($characters, 200);
    }

    public function show($id)
    {
        $character = $this->characterModel::select('name','status','gender','race','description')->where('id', $id)->get();
        return response()->json($character, 200);
    }

    public function store(Request $request)
    {
        $data = request()->json()->all();
        $character = new $this->characterModel;

        $character->name = $data['name'];
        $character->status = $data['status'];
        $character->gender = $data['gender'];
        $character->race = $data['race'];
        $character->description = $data['description'];

        $character->save();

        $response = [
            'message' => "Персонаж сохранен",
        ];

        return response()->json($response, 200);
    }

    public function update($id)
    {
        $character = $this->characterModel::find($id);
        $data = request()->json()->all();

        $character->name = $data['name'];
        $character->status = $data['status'];
        $character->gender = $data['gender'];
        $character->race = $data['race'];
        $character->description = $data['description'];

        $character->save();

        $response = [
            'message' => "Персонаж сохранен",
        ];

        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $character = $this->characterModel::find($id);
        $character->delete();

        $response = [
            'message' => "Персонаж удален",
        ];
        return response()->json($response, 200);
    }
}


