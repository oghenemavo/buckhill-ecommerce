<?php

namespace App\Interfaces;

interface IProductRepository
{
    public function fetchProducts(array $getAttributes);

    public function add(array $productBody);

    public function fetchProduct(string $uuid);

    public function updateProduct(string $uuid, array $productBody);

    public function delete(string $uuid);
}
