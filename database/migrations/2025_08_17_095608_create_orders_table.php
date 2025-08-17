<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('customer_pay', 10, 2)->nullable();
            $table->decimal('change_amount', 10, 2)->nullable();
            $table->string('payment_method')->default('cash'); // cash, credit, paypal
            $table->string('status')->default('pending'); // pending, preparing, served, completed
            $table->string('card_number')->nullable();
            $table->string('expiry')->nullable();
            $table->string('cvc')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
