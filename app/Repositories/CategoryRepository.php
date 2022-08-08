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
        return $this->category->create([
            'title' => data_get($attributes, 'title'),
        ]);
    }

    public function fetchCategory($uuid)
    {
        return $this->category->query()->where('uuid', $uuid)->firstOrFail();
    }

    public function updateCategory($uuid, array $attributes)
    {
        $this->category->query()->where('uuid', $uuid)->firstOrFail();

        return $this->category->update([
            'title' => data_get($attributes, 'title', $this->category->title),
        ]);
    }

    public function delete($uuid)
    {
        $this->category->query()->where('uuid', $uuid)->firstOrFail();

        return $this->category->delete();
    }
}
