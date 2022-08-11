<?php

namespace App\Interfaces;

interface IAdminRepository
{
    public function createAdmin(array $adminBody);

    public function fetchUsers(array $getAttributes);

    public function updateUser(array $adminBody, string $uuid);

    public function deleteUser(string $uuid);
}
