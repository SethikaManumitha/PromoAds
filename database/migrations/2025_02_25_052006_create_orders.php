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
            $table->string('fullname');
            $table->string('address');
            $table->string('city');
            $table->string('phone');
            $table->decimal('total', 8, 2);
            $table->string('payment_method');

            // Driver ID Foreign Key
            $table->string('driver_id');
            $table->foreign('driver_id')->references('NIC')->on('drivers')->onDelete('cascade');

            // Shop ID Foreign Key
            $table->unsignedInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('businesses')->onDelete('cascade');

            // Order Statuses
            $table->enum('business_status', ['pending', 'processing', 'ready_for_pickup', 'completed', 'canceled', 'on_hold', 'delivered'])->default('pending');
            $table->enum('driver_status', ['pending', 'assigned', 'on_the_way', 'picked_up', 'delivered', 'canceled'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
