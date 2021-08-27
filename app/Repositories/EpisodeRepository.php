<?php

namespace App\Repositories;

use App\Http\Resources\EpisodeCollection;
use App\Models\Episode;

class EpisodeRepository
{
    public function index(array $params)
    {
        $query = Episode::with(['Image']);

        if (isset($params['season']))
            $query = Episode::whereIn('season', $params['season']);

        if (isset($params['series']))
            $query->whereIn('series', $params['series']);

        if (isset($params['premiere_from']))
            $query->where('premiere', '>=', $params['premiere_from']);

        if (isset($params['premiere_to']))
            $query->where('premiere', '<=', $params['premiere_to']);

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

    public function get($id): ?Episode
    {
        return Episode::find($id);
    }

    public function getCharacters($id)
    {
        return Episode::find($id)->characters;
    }

    public function store(array $data): Episode
    {
        return Episode::create($data);
    }

    public function update($model, $data)
    {
        return $model->update($data);
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    public function existsName($name, $id = 0): bool
    {
        return Episode::where('name', '=', $name)->where('id', '!=', $id)->exists();
    }
}
