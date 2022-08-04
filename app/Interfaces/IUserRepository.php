<?php

namespace App\Interfaces;

interface IUserRepository
{
    public function createUser(array $userBody);
}
