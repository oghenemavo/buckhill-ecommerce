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
}
