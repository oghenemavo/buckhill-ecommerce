<?php

namespace App\Repositories;

use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;

class OrderRepository implements IOrderRepository
{
    public function __construct(protected Order $order)
    {
        $this->order = $order;
    }

    public function fetchOrders(array $attributes)
    {
        $query = $this->order->query();
        return generatePaginationQuery($query, $attributes);
    }

    public function add(array $attributes)
    {
        $orderStatusId = (string) data_get($attributes, 'order_status_id');
        $products = data_get($attributes, 'products');
        $productPrice = $amount = $deliveryFee = (float) 0;
        $orderStatus = OrderStatus::query()->where('id', $orderStatusId)->first();
        $shippedAt = shippedAt($orderStatus->title);

        foreach ($products as $item) {
            $productPrice = Product::query()->uuid($item['product'])->first()->price;
            $amount += $item['quantity'] * $productPrice;
        }

        $deliveryFee = deliveryCharges($amount);

        return $this->order->create([
            'user_id' => (string) auth()->user()->id ?? '1',
            'order_status_id' => $orderStatusId,
            'payment_id' => (string) data_get($attributes, 'payment_id'),
            'products' => json_encode($products),
            'address' => json_encode(data_get($attributes, 'address')),
            'amount' => $amount,
            'delivery_fee' => $deliveryFee,
            'shipped_at' => $shippedAt,
        ]);
    }

    public function fetchOrder($uuid)
    {
        return $this->order->query()->where('uuid', $uuid)->firstOrFail();
    }

    public function updateOrder($uuid, array $attributes)
    {
        $orderObject = $this->order->query()->where('uuid', $uuid)->firstOrFail();

        $orderStatusId = (string) data_get($attributes, 'order_status_id', $orderObject->order_status_id);
        $products = data_get($attributes, 'products', $orderObject->products);
        $productPrice = $amount = $deliveryFee = (float) 0;
        $orderStatus = OrderStatus::query()->where('id', $orderStatusId)->first();
        $shippedAt = shippedAt($orderStatus->title);

        foreach ($products as $item) {
            $productPrice = Product::query()->uuid($item['product'])->first()->price;
            $amount += $item['quantity'] * $productPrice;
        }

        $deliveryFee = deliveryCharges($amount);

        return $this->order->create([
            'user_id' => auth()->user()->id ?? '1',
            'order_status_id' => $orderStatusId,
            'payment_id' => (string) data_get($attributes, 'payment_id', $orderObject->payment_id),
            'products' => json_encode($products),
            'address' => json_encode(data_get($attributes, 'address', $orderObject->address)),
            'amount' => $amount,
            'delivery_fee' => $deliveryFee,
            'shipped_at' => $shippedAt,
        ]);
    }

    public function delete($uuid)
    {
        $orderObject = $this->order->query()->where('uuid', $uuid)->firstOrFail();

        return $orderObject->delete();
    }
}
