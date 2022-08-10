<?php

namespace Database\Seeders;

use App\Enums\PaymentType;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use stdClass;

class CustomerOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $products = Product::query()->get();
            $orderStatuses = OrderStatus::query()->get();
            $paymentTypes = PaymentType::cases();
    
            User::query()->inRandomOrder()->get()->map(function ($user) use ($products, $orderStatuses, $paymentTypes) {
                $itemsArray = [];
                $orderStatus = $orderStatuses->random();
                $productAcquired = random_int(1, 5);
                $amount = (float) 0;
    
                for ($i = 1; $i < $productAcquired; $i++) {
                    $product = $products->random();
                    $quantity = random_int(1, 20);
    
                    if (empty($product)) {
                        continue;
                    }
    
                    $itemsArray[$i] = [
                        'product' => $product->uuid,
                        'quantity' => $quantity,
                    ];
                    $amount += $quantity * $product->price;
                }
    
                $paymentType = $paymentTypes[array_rand($paymentTypes)]->value;
                $paymentDetails = $this->generatePaymentDetails($paymentType);
    
                DB::beginTransaction();

                $payment = Payment::create([
                    'type' => $paymentType,
                    'details' => $paymentDetails,
                ]);
    
                if (! empty($itemsArray)) {
                    $user->orders()->create([
                        'user_id' => $user->id,
                        'order_status_id' => $orderStatus->id,
                        'payment_id' => $payment->id,
                        'products' => json_encode($itemsArray),
                        'address' => json_encode($this->generateAddress()),
                        'delivery_fee' => $this->delivery_charges($amount),
                        'amount' => $amount,
                        'shipped_at' => $this->shippedAt($orderStatus->title),
                    ]);

                    DB::commit();
                } else {
                    // delete payment that doesn't have product
                    DB::rollBack(); // if there are no items in $itemsArray then rollback the payment
                }
            });
            
        } catch (\Exception  $ex) {
            DB::rollBack();
            echo $ex->getMessage();
        }
    }

    protected function shippedAt($status)
    {
        return $status == 'shipped' ? Carbon::now() : null;
    }

    protected function generatePaymentDetails(string $type): string|false
    {
        $details = '';
        switch (PaymentType::tryFrom($type)) {
            case PaymentType::CREDIT_CARD:
                $details = json_encode($this->generateCardPaymentDetails());
                break;

            case PaymentType::CASH_ON_DELIVERY:
                $details = json_encode($this->generateCashPaymentDetails());
                break;

            case PaymentType::BANK_TRANSFER:
                $details = json_encode($this->generateBankTransferDetails());
                break;
        }
        return $details;
    }

    protected function generateAddress()
    {
        return [
            'billing' => fake()->address(),
            'shipping' => fake()->address(),
        ];
    }

    protected function generateCardPaymentDetails()
    {
        return [
            'holder_name' => fake()->name(),
            'number' => fake()->creditCardNumber(),
            'ccv' => random_int(111, 999),
            'expire_date' => fake()->creditCardExpirationDateString(),
        ];
    }

    protected function generateCashPaymentDetails()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'address' => fake()->address(),
        ];
    }

    protected function generateBankTransferDetails()
    {
        return [
            'swift' => fake()->swiftBicNumber(),
            'iban' => fake()->iban(),
            'name' => fake()->name(),
        ];
    }

    protected function delivery_charges(float $amount)
    {
        return $amount > 500 ? 15.00 : null;
    }
}
