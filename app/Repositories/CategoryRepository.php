<?php

namespace App\Repositories;

use App\Interfaces\ICategoryRepository;
use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function __construct(protected Category $category)
    {
        $this->category = $category;
    }

    public function fetchCategories()
    {
        return $this->category->query()->get();
    }

    public function add(array $attributes)
    {
        $categoryObject = $this->category->create([
            'title' => data_get($attributes, 'title'),
        ]);

        return $categoryObject;
    }

    public function fetchCategory($uuid)
    {
        return $this->category->query()->where('uuid', $uuid)->firstOrFail();
    }

    public function updateCategory($uuid, array $attributes)
    {
        $categoryObject = Category::query()->where('uuid', $uuid)->firstOrFail();

        return $categoryObject->update([
            'title' => data_get($attributes, 'title', $categoryObject->title),
        ]);
    }

    public function delete($uuid)
    {
        $category = Category::query()->where('uuid', $uuid)->firstOrFail();

        return $category->delete();
    }
}
