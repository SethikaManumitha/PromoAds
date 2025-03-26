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
            $table->string('driver_id');
            $table->foreign('driver_id')->references('NIC')->on('drivers')->onDelete('cascade'); // Added foreign key constraint
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
