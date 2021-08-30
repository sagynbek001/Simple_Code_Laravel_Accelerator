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

    public function get($phone): ?User
    {
        return User::where('phone', $phone)->first();
    }

    public function store(array $data): User
    {
        return User::create($data);
    }
}
