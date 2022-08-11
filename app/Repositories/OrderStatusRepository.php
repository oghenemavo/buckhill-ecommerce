<?php

namespace App\Repositories;

use App\Interfaces\IOrderStatusRepository;
use App\Models\OrderStatus;

class OrderStatusRepository implements IOrderStatusRepository
{
    public function __construct(protected OrderStatus $orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    public function fetchOrderStatuses(array $attributes)
    {
        return generatePaginationQuery($this->orderStatus, $attributes);
    }

    public function add(array $attributes)
    {
        return $this->orderStatus->create([
            'title' => data_get($attributes, 'title'),
        ]);
    }

    public function fetchOrderStatus($uuid)
    {
        return $this->orderStatus->query()->where('uuid', $uuid)->firstOrFail();
    }

    public function updateOrderStatus($uuid, array $attributes)
    {
        $orderStatusObject = $this->orderStatus->query()->where('uuid', $uuid)->firstOrFail();

        return $orderStatusObject->update([
            'title' => data_get($attributes, 'title', optional($orderStatusObject)->title),
        ]);
    }

    public function delete($uuid)
    {
        $orderStatusObject = $this->orderStatus->query()->where('uuid', $uuid)->firstOrFail();

        return $orderStatusObject->delete();
    }
}
