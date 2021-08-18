<?php

namespace App\Repositories;

use App\Models\Character;

class CharacterRepository
{
    public function index($request)
    {
        //status, race, gender filter
        //order (desc, asc)
        //sort (attribute)
        //поиск по имени и дескрипшну

        if (isset($request['gender']))
            $query = Character::whereIn('gender', $request['gender']);

        if (isset($request['race']))
            $query->whereIn('race', $request['race']);

        if (isset($request['status']))
            $query->whereIn('status', $request['status']);

        if (isset($request['search'])){
            $query
            ->where('name',           'LIKE', '%' . $request['search']  . '%')
            ->orWhere('description',  'LIKE', '%' . $request['search']  . '%');
        }

        if (isset($request['sort'])){
            if (isset($request['order'])){
                $query->orderBy($request['sort'], $request['order']);
            } else {
                $query->orderBy($request['sort'], 'asc');
            }
        }

        if (isset($request['per_page'])) {
            return $query->paginate($request['per_page']);
        } else {
            return $query->paginate(3);
        }
    }

    public function get($id): ?Character
    {
        return Character::find($id);
    }

    public function store(array $data): Character
    {
        return Character::create($data);
    }

    public function update($model, $data): ?Character
    {
        return $model->update($data);
    }

    public function destroy($model): ?Character
    {
        return $model->delete();
    }

    public function existsName($name, $id): bool
    {
        return 45;
    }
}
