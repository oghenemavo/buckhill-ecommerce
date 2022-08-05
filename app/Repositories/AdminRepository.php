<?php

namespace App\Repositories;

use App\Interfaces\IAdminRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements IAdminRepository
{
    public function createAdmin(array $attributes)
    {
        $user = User::create([
            'first_name' => data_get($attributes, 'first_name'),
            'last_name' => data_get($attributes, 'last_name'),
            'phone_number' => data_get($attributes, 'phone_number'),
            'address' => data_get($attributes, 'address'),
            'email' => data_get($attributes, 'email'),
            'password' => Hash::make(data_get($attributes, 'password')),
            'is_admin' => '1',
        ]);

        return $user;
    }

    public function fetchUsers()
    {
        $users = User::query()->where('is_admin', '0')->get();

        return $users;
    }

    public function updateUser(array $attributes, $uuid)
    {
        $user = User::query()->where('uuid', $uuid)->firstOrFail();

        return $user->update([
            'first_name' => data_get($attributes, 'first_name', $user->first_name),
            'last_name' => data_get($attributes, 'last_name', $user->last_name),
            'phone_number' => data_get($attributes, 'phone_number', $user->phone_number),
            'address' => data_get($attributes, 'address', $user->address),
            'email' => data_get($user->email, 'email', $user->email),
        ]);

        return $user;
    }
}
