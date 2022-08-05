<?php

namespace App\Interfaces;

use App\Models\User;

interface IUserRepository
{
    public function createUser(array $userBody);

    public function updateUser(array $userBody, User $user);
}
