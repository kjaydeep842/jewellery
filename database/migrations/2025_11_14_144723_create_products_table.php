<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            // Prices
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();

            // SKU & Stock
            $table->string('sku')->unique()->nullable();
            $table->integer('stock')->default(0);

            // Categories
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');

            // Images
            $table->string('image')->nullable(); // main image
            $table->json('gallery')->nullable(); // multiple images

            // Jewelry specific
            $table->string('material')->nullable(); // gold, silver, diamond
            $table->string('weight')->nullable();   // e.g. "12g"

            // Status
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
