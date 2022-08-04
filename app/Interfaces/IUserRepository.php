<?php

namespace App\Interfaces;

use App\Models\User;

interface IUserRepository
{
    public function createUser(array $userBody): User;
    public function updateUser(array $userBody, User $user);
}
