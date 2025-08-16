<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('phone', 50);
            $table->text('address');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('customer_pay', 10, 2);
            $table->decimal('change_amount', 10, 2);
            $table->string('payment_method'); // cash, card, etc.
            $table->string('card_number')->nullable();
            $table->string('expiry')->nullable();
            $table->string('cvc')->nullable();
            $table->string('image')->nullable(); // optional order image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
