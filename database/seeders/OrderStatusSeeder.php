<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
