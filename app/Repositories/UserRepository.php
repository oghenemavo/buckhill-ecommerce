<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function __construct(protected User $user)
    {
        $this->user = $user;
    }

    public function createUser(array $attributes)
    {
        return $this->user->create([
            'first_name' => data_get($attributes, 'first_name'),
            'last_name' => data_get($attributes, 'last_name'),
            'phone_number' => data_get($attributes, 'phone_number'),
            'address' => data_get($attributes, 'address'),
            'email' => data_get($attributes, 'email'),
            'password' => Hash::make(data_get($attributes, 'password')),
        ]);
    }

    public function updateUser(array $attributes, User $user)
    {
        return $user->update([
            'first_name' => data_get($attributes, 'first_name', $user->first_name),
            'last_name' => data_get($attributes, 'last_name', $user->last_name),
            'phone_number' => data_get($attributes, 'phone_number', $user->phone_number),
            'address' => data_get($attributes, 'address', $user->address),
            'email' => data_get($user->email, 'email', $user->email),
        ]);
    }
}
