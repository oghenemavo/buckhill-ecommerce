<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function createUser(array $attributes): bool
    {
        $user = User::create([
            'name' => data_get($attributes, 'name'),
            'email' => data_get($attributes, 'email'),
            'password' => Hash::make(data_get($attributes, 'password')),
        ]);

        return $user;
    }
}
