<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::query()->get();
        $orderStatuses = OrderStatus::query()->get();

        
        User::query()->inRandomOrder()->get()->map(function($user) use($products, $orderStatuses) {
            $paymentTypes = [
                'credit_card',
                'cash_on_delivery',
                'bank_transfer',
            ];
            $ccPayment = [
                'holder_name' => fake()->name(),
                'number' => fake()->creditCardNumber(),
                'ccv' => random_int(111, 999),
                'expire_date' => fake()->creditCardExpirationDateString(),
            ];
            $cashPayment = [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'address' => fake()->address()
            ];
            $bankPayment = [
                'swift' => fake()->swiftBicNumber(),
                'iban' => fake()->iban(),
                'name' => fake()->name()
            ];

            $itemsArray = [];
            $orderStatus = $orderStatuses->random();
            $productAcquired = random_int(1, 5);
            $amount = (float) 0;
            $address = [
                'billing' => fake()->address(),
                'shipping' => fake()->address(),
            ];
            
            for ($i=1; $i < $productAcquired; $i++) {
                $product = $products->random();
                $quantity = random_int(1, 20);

                if (empty($product)) continue;

                $itemsArray[$i] = [
                    'product' => $product->uuid,
                    'quantity' => $quantity
                ];
                $amount += $quantity * $product->price;
            }

            
            $paymentType = $paymentTypes[array_rand($paymentTypes)];
            $paymentDetails = [];
            switch ($paymentType) {
                case 'credit_card':
                    $paymentDetails = json_encode($ccPayment);
                    break;

                case 'cash_on_delivery':
                    $paymentDetails = json_encode($cashPayment);
                    break;

                case 'bank_transfer':
                    $paymentDetails = json_encode($bankPayment);
                    break;
            }

            $payment = Payment::create([
                'type' => $paymentType,
                'details' => $paymentDetails,
            ]);

            if (!empty($itemsArray)) {
                $user->orders()->create([
                    'user_id' => $user->id,
                    'order_status_id' => $orderStatus->id,
                    'payment_id' => $payment->id,
                    'products' => json_encode($itemsArray),
                    'address' => json_encode($address),
                    'delivery_fee' => $this->delivery_charges($amount),
                    'amount' => $amount,
                    'shipped_at' => random_int(0, 1) ? Carbon::now() : null,
                ]);
            }

            // delete payment that doesn't have product


            // $user->orders()->
        });
    }

    protected function delivery_charges(float $amount)
    {
        return $amount > 500 ? 15.00 : null;
    }
}
