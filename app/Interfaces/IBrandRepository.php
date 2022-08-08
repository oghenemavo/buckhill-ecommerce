<?php

namespace App\Interfaces;

interface IBrandRepository
{
    public function fetchBrands();

    public function add(array $brandBody);

    public function fetchBrand(string $uuid);

    public function updateBrand(string $uuid, array $brandBody);

    public function delete(string $uuid);
}
