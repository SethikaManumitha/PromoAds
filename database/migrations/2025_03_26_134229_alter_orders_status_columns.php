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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('business_status')->default('pending')->change();

            // Change the driver_status column from enum to string
            $table->string('driver_status')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Rollback the changes (change back to enum)
            $table->enum('business_status', ['pending', 'processing', 'ready_for_pickup', 'completed', 'canceled', 'on_hold', 'delivered'])->default('pending')->change();
            $table->enum('driver_status', ['pending', 'assigned', 'on_the_way', 'picked_up', 'delivered', 'canceled'])->default('pending')->change();
        });
    }
};
