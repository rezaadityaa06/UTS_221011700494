<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eco_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('material');
            $table->decimal('price', 12, 2);
            $table->unsignedTinyInteger('eco_rating');
            $table->string('image');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eco_products');
    }
};
