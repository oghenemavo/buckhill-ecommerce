<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::factory()->count(5)->sequence(
            ['title' => 'open'],
            ['title' => 'pending payment'],
            ['title' => 'paid'],
            ['title' => 'shipped'],
            ['title' => 'cancelled'],
        )
        ->create();
    }
}
