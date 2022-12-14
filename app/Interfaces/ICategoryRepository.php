<?php

namespace App\Interfaces;

interface ICategoryRepository
{
    public function fetchCategories(array $getAttributes);

    public function add(array $categoryBody);

    public function fetchCategory(string $uuid);

    public function updateCategory(string $uuid, array $categoryBody);

    public function delete(string $uuid);
}
