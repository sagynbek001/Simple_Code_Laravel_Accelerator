<?php

namespace App\Repositories;

use App\Models\Character;
use App\Http\Resources\CharacterCollection;

class CharacterRepository
{
    public function index($request)
    {
        //status, race, gender filter
        //order (desc, asc)
        //sort (attribute)
        //поиск по имени и дескрипшну

        if (array_key_exists('gender', $request))
            $query = Character::whereIn('gender', $request['gender']);

        if (array_key_exists('race', $request))
            $query->whereIn('race', $request['race']);

        if (array_key_exists('status', $request))
            $query->whereIn('status', $request['status']);

        if (array_key_exists('search', $request)){
            $query
            ->where('name',           'LIKE', '%' . $request['search']  . '%')
            ->orWhere('description',  'LIKE', '%' . $request['search']  . '%');
        }

        if (array_key_exists('sort', $request)){
            if (array_key_exists('order', $request)){
                $query->orderBy($request['sort'], $request['order']);
            } else {
                $query->orderBy($request['sort'], 'asc');
            }
        }

        if (array_key_exists('per_page', $request)) {
            return $query->paginate($request['per_page']);
        } else {
            return $query->paginate(3);
        }
    }

    public function get($id)
    {
        return Character::findOrFail($id);
    }

    public function store($request)
    {
        Character::create($request);
    }

    public function update($id, $request)
    {
        Character::where('id', $id)->update($request);
    }

    public function destroy($id)
    {
        Character::find($id)->delete();
    }
}
