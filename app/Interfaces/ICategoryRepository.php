<?php

namespace App\Interfaces;

interface ICategoryRepository
{
    public function fetchCategories();

    public function add(array $categoryBody);

    public function fetchCategory(string $uuid);

    public function updateCategory(string $uuid, array $userBody);

    public function delete(string $uuid);
}
