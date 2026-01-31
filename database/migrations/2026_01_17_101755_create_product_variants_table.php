<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // Differentiators
            $table->string('size')->nullable(); // Ring Size: 12, 14
            $table->string('color')->nullable(); // Metal Color: Yellow, White, Rose
            $table->string('material_purity')->nullable(); // Override if needed per variant
            $table->string('diamond_quality')->nullable(); // SI-IJ, VVS-EF

            // Specific Data
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2); // Final price for this variant
            $table->integer('stock_quantity')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
