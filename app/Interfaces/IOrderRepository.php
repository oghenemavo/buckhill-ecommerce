<?php

namespace App\Interfaces;

interface IOrderRepository
{
    public function fetchOrders(array $getAttributes);

    public function fetchOrdersByShipment(array $getAttributes);

    public function add(array $orderBody);

    public function fetchOrder(string $uuid);

    public function updateOrder(string $uuid, array $orderBody);

    public function delete(string $uuid);
}
