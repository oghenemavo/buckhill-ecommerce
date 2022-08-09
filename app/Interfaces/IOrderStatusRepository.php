<?php

namespace App\Interfaces;

interface IOrderStatusRepository
{
    public function fetchOrderStatuses();

    public function add(array $statusBody);

    public function fetchOrderStatus(string $uuid);

    public function updateOrderStatus(string $uuid, array $statusBody);

    public function delete(string $uuid);
}
