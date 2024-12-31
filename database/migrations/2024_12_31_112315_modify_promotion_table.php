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
        //
        Schema::table('promotion', function (Blueprint $table) {
            // Changing the column types of price and dis_price to double
            $table->double('price', 8, 2)->change();
            $table->double('dis_price', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('promotion', function (Blueprint $table) {
            // Reverting back to previous types if needed
            $table->decimal('price', 8, 2)->change();
            $table->decimal('dis_price', 8, 2)->change();
        });
    }
};
