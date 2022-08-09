<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)
        ->sequence(function ($sequence) {
            if ($sequence->index == '0') {
                return [
                    'email' => 'admin@buckhill.co.uk',
                    'password' => Hash::make('admin'),
                    'is_admin' => '1',
                ];
            } else {
                return [
                    'is_admin' => '0',
                ];
            }
        })
        ->create();
    }
}
