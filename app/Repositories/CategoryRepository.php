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

    public function fetchCategories(array $attributes)
    {
        $query = $this->category->query();
        return generatePaginationQuery($query, $attributes);
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
        $categoryObject = $this->category->query()->where('uuid', $uuid)->firstOrFail();

        return $categoryObject->update([
            'title' => data_get($attributes, 'title', $categoryObject->title),
        ]);
    }

    public function delete($uuid)
    {
        $categoryObject = $this->category->query()->where('uuid', $uuid)->firstOrFail();

        return $categoryObject->delete();
    }
}
