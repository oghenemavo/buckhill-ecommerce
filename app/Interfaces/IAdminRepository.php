<?php

namespace App\Interfaces;

interface IAdminRepository
{
    public function createAdmin(array $adminBody);

    public function fetchUsers();

    public function updateUser(array $adminBody, string $uuid);
}
