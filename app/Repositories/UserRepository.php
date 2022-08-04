<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function createUser(array $attributes): User
    {
        $user = User::create([
            'first_name' => data_get($attributes, 'first_name'),
            'last_name' => data_get($attributes, 'last_name'),
            'phone_number' => data_get($attributes, 'phone_number'),
            'address' => data_get($attributes, 'address'),
            'email' => data_get($attributes, 'email'),
            'password' => Hash::make(data_get($attributes, 'password')),
        ]);

        return $user;
    }
}
