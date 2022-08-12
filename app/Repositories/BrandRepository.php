<?php

namespace App\Repositories;

use App\Interfaces\IBrandRepository;
use App\Models\Brand;

class BrandRepository implements IBrandRepository
{
    public function __construct(protected Brand $brand)
    {
        $this->brand = $brand;
    }

    public function fetchBrands(array $attributes)
    {
        $query = $this->brand->query();

        return generatePaginationQuery($query, $attributes);
    }

    public function add(array $attributes)
    {
        return $this->brand->create([
            'title' => data_get($attributes, 'title'),
        ]);
    }

    public function fetchBrand($uuid)
    {
        return $this->brand->query()->where('uuid', $uuid)->firstOrFail();
    }

    public function updateBrand($uuid, array $attributes)
    {
        $brandObject = $this->brand->query()->where('uuid', $uuid)->firstOrFail();

        return $brandObject->update([
            'title' => data_get($attributes, 'title', $brandObject->title),
        ]);
    }

    public function delete($uuid)
    {
        $brandObject = $this->brand->query()->where('uuid', $uuid)->firstOrFail();

        return $brandObject->delete();
    }
}
