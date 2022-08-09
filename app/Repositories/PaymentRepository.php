<?php

namespace App\Repositories;

use App\Interfaces\IPaymentRepository;
use App\Models\Payment;

class PaymentRepository implements IPaymentRepository
{
    public function __construct(protected Payment $payment)
    {
        $this->payment = $payment;
    }

    public function fetchPayments()
    {
        return $this->payment->query()->get();
    }

    public function add(array $attributes)
    {
        return $this->payment->create([
            'type' => data_get($attributes, 'type'),
            'details' => json_encode(data_get($attributes, 'details')),
        ]);
    }

    public function fetchPayment($uuid)
    {
        return $this->payment->query()->where('uuid', $uuid)->firstOrFail();
    }

    public function updatePayment($uuid, array $attributes)
    {
        $paymentObject = $this->payment->query()->where('uuid', $uuid)->firstOrFail();

        return $paymentObject->update([
            'type' => data_get($attributes, 'type', optional($paymentObject)->type),
            'details' => json_encode(data_get($attributes, 'details', optional($paymentObject)->details)),
        ]);
    }

    public function delete($uuid)
    {
        $paymentObject = $this->payment->query()->where('uuid', $uuid)->firstOrFail();

        return $paymentObject->delete();
    }
}
