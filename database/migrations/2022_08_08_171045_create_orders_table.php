<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('order_status_id')->references('id')->on('order_statuses');
            $table->foreignId('payment_id')->references('id')->on('payments');
            $table->char('uuid', 36)->unique();
            $table->json('products');
            $table->json('address');
            $table->decimal('delivery_fee', 11, 2);
            $table->decimal('amount', 11, 2);
            $table->timestamps();
            $table->dateTime('shipped_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
