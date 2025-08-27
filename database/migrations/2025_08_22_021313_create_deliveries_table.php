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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('delivery_id');

            // Foreign keys
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('customer_id');

            // Delivery details
            $table->string('delivery_address');
            $table->enum('delivery_status', ['Pending', 'In Transit', 'Delivered', 'Cancelled'])->default('Pending');
            $table->date('delivery_date');
            $table->time('delivery_time')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
