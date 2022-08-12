<?php

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

if (! function_exists('generatePaginationQuery')) {
    function generatePaginationQuery(Builder $builder, array $args): LengthAwarePaginator
    {
        $page = data_get($args, 'page', 1); // start from
        $perPage = data_get($args, 'limit', 10); // limit
        $desc = data_get($args, 'desc', false) == true ? 'desc' : 'asc';
        $sortBy = data_get($args, 'sort_by');
        $dateRangeFrom = data_get($args, 'date_range_from');
        $dateRangeTo = data_get($args, 'date_range_to');
        $fixRange = data_get($args, 'fix_range');

        if (! is_null($dateRangeFrom) && is_null($dateRangeTo)) {
            $builder->whereDate('created_at', '>=', $dateRangeFrom);
        } elseif (is_null($dateRangeFrom) && ! is_null($dateRangeTo)) {
            $builder->whereDate('created_at', '<=', $dateRangeTo);
        } elseif (! is_null($dateRangeFrom) && ! is_null($dateRangeTo)) {
            $builder->whereBetween('created_at', [$dateRangeFrom, $dateRangeTo]);
        }

        if (! is_null($fixRange) && strtolower($fixRange) == 'daily') {
            $builder->whereDay('created_at', Carbon::now()->day);
        } elseif (! is_null($fixRange) && strtolower($fixRange) == 'monthly') {
            $builder->whereMonth('created_at', Carbon::now()->month);
        } elseif (! is_null($fixRange) && strtolower($fixRange) == 'yearly') {
            $builder->whereYear('created_at', Carbon::now()->year);
        }

        if (! is_numeric($perPage)) {
            $perPage = 10;
        }

        if (! is_numeric($page)) {
            $page = 1;
        }

        if (! is_string($sortBy)) {
            $builder->orderBy('id', $desc);
        } else {
            $builder->orderBy($sortBy, $desc);
        }

        return $builder->paginate($perPage, ['*'], 'page', $page);
    }
}

if (! function_exists('shippedAt')) {
    function shippedAt($status)
    {
        return strtolower($status) == 'shipped' ? Carbon::now() : null;
    }
}

if (! function_exists('deliveryCharges')) {
    function deliveryCharges(float $amount)
    {
        return $amount > 500 ? 15.00 : null;
    }
}

if (! function_exists('getProduct')) {
    function getProduct($uuid)
    {
        return Product::query()->uuid($uuid)->first();
    }
}
