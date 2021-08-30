<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function index(array $params)
    {
        $query = Location::with(['Image']);

        if (isset($params['type']))
            $query->whereIn('type', $params['type']);

        if (isset($params['dimension']))
            $query->whereIn('dimension', $params['dimension']);

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

    public function get($id): ?Location
    {
        return Location::find($id);
    }

    public function store(array $data): Location
    {
        return Location::create($data);
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
        return Location::where('id', $id)->update(array('image_id' => $image_id));
    }

    public function destroyImage($id)
    {
        return Location::where('id', $id)->update(array('image_id' => null));
    }


    public function existsName($name, $id = null)
    {
        return Location::where('name', '=', $name)->where('id', '!=', $id)->exists();
    }
}
