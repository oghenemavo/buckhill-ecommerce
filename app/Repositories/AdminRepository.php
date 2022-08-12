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

    public function fetchUsers(array $attributes)
    {
        $query = $this->user->query()->where('is_admin', '0');

        return generatePaginationQuery($query, $attributes);
    }

    public function updateUser(array $attributes, $uuid)
    {
        $userObject = $this->user->query()->where('uuid', $uuid)->firstOrFail();

        return $userObject->update([
            'first_name' => data_get($attributes, 'first_name', $userObject->first_name),
            'last_name' => data_get($attributes, 'last_name', $userObject->last_name),
            'phone_number' => data_get($attributes, 'phone_number', $userObject->phone_number),
            'address' => data_get($attributes, 'address', $userObject->address),
            'email' => data_get($attributes, 'email', $userObject->email),
        ]);
    }

    public function deleteUser($uuid)
    {
        $userObject = $this->user->query()->where('uuid', $uuid)->firstOrFail();

        return $userObject->delete();
    }
}
