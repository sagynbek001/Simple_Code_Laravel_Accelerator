<?php

namespace App\Repositories;

use App\Models\Character;

class CharacterRepository
{
    public function index(array $params)
    {
        $query = Character::with(['Image', 'birthLocation', 'currentLocation']);

        if (isset($params['gender']))
            $query->whereIn('gender', $params['gender']);

        if (isset($params['race']))
            $query->whereIn('race', $params['race']);

        if (isset($params['status']))
            $query->whereIn('status', $params['status']);

        if (isset($params['search'])){
            $query->where(function ($subQuery) use ($params) {
                $subQuery->where('name', 'LIKE', '%' . $params['search'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $params['search'] . '%');
            });
        }

        if (isset($params['sort'])){
            if (isset($params['order'])){
                $query->orderBy($params['sort'], $params['order']);
            } else {
                $query->orderBy($params['sort'], 'asc');
            }
        }

        if (isset($params['per_page'])) {
            return $query->paginate($params['per_page']);
        } else {
            return $query->paginate(10);
        }
    }

    public function get($id): ?Character
    {
        return Character::find($id);
    }

    public function getEpisodes($model, $params)
    {
        $query = $model->episodes();
        if (isset($params['per_page'])) {
            return $query->paginate($params['per_page']);
        } else {
            return $query->paginate(10);
        }
    }

    public function store(array $data): Character
    {
        return Character::create($data);
    }

    public function update($model, $data)
    {
        return $model->update($data);
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    public function storeImage($id, $image_id)
    {
        return Character::where('id', $id)->update(array('image_id' => $image_id));
    }

    public function destroyImage($id)
    {
        return Character::where('id', $id)->update(array('image_id' => null));
    }

    public function existsName($name, $id = 0): bool
    {
        return Character::where('name', '=', $name)->where('id', '!=', $id)->exists();
    }
}
