<?php

namespace App\Repositories;

use App\Interfaces\IProductRepository;
use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function __construct(protected Product $product)
    {
        $this->product = $product;
    }

    public function fetchProducts()
    {
        return $this->product->query()->get();
    }

    public function add(array $attributes)
    {
        return $this->product->create([
            'category_uuid' => data_get($attributes, 'category_uuid'),
            'title' => data_get($attributes, 'title'),
            'price' => data_get($attributes, 'price'),
            'description' => data_get($attributes, 'description'),
            'metadata' => json_encode(data_get($attributes, 'metadata')),
        ]);
    }

    public function fetchProduct($uuid)
    {
        return $this->product->query()->where('uuid', $uuid)->firstOrFail();
    }

    public function updateProduct($uuid, array $attributes)
    {
        $productObject = $this->product->query()->where('uuid', $uuid)->firstOrFail();

        return $productObject->update([
            'category_uuid' => data_get($attributes, 'category_uuid', $productObject->category_uuid),
            'title' => data_get($attributes, 'title', $productObject->title),
            'price' => data_get($attributes, 'price', $productObject->price),
            'description' => data_get($attributes, 'description', $productObject->description),
            'metadata' => json_encode(data_get($attributes, 'metadata', $productObject->metadata)),
        ]);
    }

    public function delete($uuid)
    {
        $productObject = $this->product->query()->where('uuid', $uuid)->firstOrFail();

        return $productObject->delete();
    }
}
