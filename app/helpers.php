<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

if (!function_exists('generatePaginationQuery')) {
    function generatePaginationQuery(Model $model, array $args): LengthAwarePaginator
    {
        $page = data_get($args, 'page', 1); // start from
        $perPage = data_get($args, 'limit', 10); // limit 
        $desc = data_get($args, 'desc', false) == true ? 'desc' : 'asc';
        $sortBy = data_get($args, 'sort_by');

        $query = $model->query();

        if (!is_numeric($perPage)) {
            $perPage = 10;
        }

        if (!is_numeric($page)) {
            $page = 1;
        }

        if (!is_string($sortBy)) {
            return $query->orderBy('id', $desc)->paginate($perPage, ['*'], 'page', $page);
        }
        return $query->orderBy($sortBy, $desc)->paginate($perPage, ['*'], 'page', $page);
    }
}