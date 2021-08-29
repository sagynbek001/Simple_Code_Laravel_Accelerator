<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserRepository
{
    public function register(array $data){
        return $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function index(array $params)
    {
        $query = User::with(['Image', 'birthLocation', 'currentLocation']);

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

    public function get($phone): ?User
    {
        return User::where('phone', $phone)->first();
    }

    public function store(array $data): User
    {
        return User::create($data);
    }
}
