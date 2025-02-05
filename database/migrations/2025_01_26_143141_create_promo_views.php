<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promo_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('business_id');
            $table->string('visitor_id');
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');

            // Ensure visitor_id is unique for each business_id
            $table->unique(['business_id', 'visitor_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo_views');
    }
};
