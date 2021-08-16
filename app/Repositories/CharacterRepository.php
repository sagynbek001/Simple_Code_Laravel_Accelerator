<?php

namespace App\Repositories;

use App\Models\Character;
use App\Http\Requests\CharacterRequest;
use Illuminate\Http\Request;

class CharacterRepository
{
    public function index(Request $request)
    {
        /*
        //status, race, gender filter
        //order (desc, asc)
        //sort (attribute)
        //поиск по имени и дескрипшну
        $query = Character::all();

        if($request->has('race')) {
            $query->where('race', $request->input('race')[0]);
            foreach ($request->input('race') as $value) {
                $query->orWhere('race', $value);
            }
        }

        ->where('name',     'LIKE', '%' . $request->input('name')      . '%')
        ->where('email',    'LIKE', '%' . $request->input('email')     . '%')
        ->where('phone',    'LIKE', '%' . $request->input('phone')     . '%')
        ->where('company',  'LIKE', '%' . $request->input('$company')  . '%')
        ->where('function', 'LIKE', '%' . $request->input('function')  . '%')
        ->where('social',   'LIKE', '%' . $request->input('social')    . '%')
        ->where('address',  'LIKE', '%' . $request->input('$address')  . '%')
        ->where('city',     'LIKE', '%' . $request->input('city')      . '%')
        ->where('postcode', 'LIKE', '%' . $request->input('postcode')  . '%');

        if($request->has('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if($request->has('birthday')) {
            $query->where('birthday', $request->input('birthday'));
        }

        $query->OrderBy('name', 'desc');
        return $query->get();

        $characters = Character::all();
        if ($request->has("search")){
            $charactersbyname = Character::where('name', 'LIKE', '%'.$request->input("search").'%')->get();
            $charactersbydesc = Character::where('description', 'LIKE', '%'.$request->input("search").'%')->get();
            $characters = $charactersbyname->merge($charactersbydesc);
        }
        $results = Project::orderBy('name')->get();
        $sorted = $characters->sortBy($request->input("sort"));
        */
    }

    public function get($id)
    {
        return Character::select('name','status','gender','race','description')->where('id', $id)->get();
    }

    public function store(CharacterRequest $request)
    {
        Character::create($request);
    }

    public function update($id, CharacterRequest $request)
    {
        Character::where('id', $id)->update($request);
    }

    public function destroy($id)
    {
        Character::find($id)->delete();
    }
}
