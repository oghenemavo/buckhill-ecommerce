<?php

namespace App\Repositories;

use App\Interfaces\IAdminRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements IAdminRepository
{
    public function __construct(protected User $user)
    {
        $this->user = $user;
    }

    public function createAdmin(array $attributes)
    {
        return $this->user->create([
            'first_name' => data_get($attributes, 'first_name'),
            'last_name' => data_get($attributes, 'last_name'),
            'phone_number' => data_get($attributes, 'phone_number'),
            'address' => data_get($attributes, 'address'),
            'email' => data_get($attributes, 'email'),
            'password' => Hash::make(data_get($attributes, 'password')),
            'is_admin' => '1',
        ]);
    }

    public function fetchUsers()
    {
        return $this->user->query()->where('is_admin', '0')->get();
    }

    public function updateUser(array $attributes, $uuid)
    {
        $this->user->query()->where('uuid', $uuid)->firstOrFail();

        return $this->user->update([
            'first_name' => data_get($attributes, 'first_name', $this->user->first_name),
            'last_name' => data_get($attributes, 'last_name', $this->user->last_name),
            'phone_number' => data_get($attributes, 'phone_number', $this->user->phone_number),
            'address' => data_get($attributes, 'address', $this->user->address),
            'email' => data_get($attributes, 'email', $this->user->email),
        ]);
    }

    public function deleteUser($uuid)
    {
        $this->user->query()->where('uuid', $uuid)->firstOrFail();

        return $this->user->delete();
    }
}
