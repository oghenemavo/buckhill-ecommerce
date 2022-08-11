<?php

namespace App\Interfaces;

interface IPaymentRepository
{
    public function fetchPayments(array $getAttributes);

    public function add(array $paymentBody);

    public function fetchPayment(string $uuid);

    public function updatePayment(string $uuid, array $paymentBody);

    public function delete(string $uuid);
}
