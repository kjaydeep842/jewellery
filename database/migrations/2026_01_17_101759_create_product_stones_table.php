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
        Schema::create('product_stones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            $table->string('type'); // Diamond, Gemstone
            $table->string('shape')->nullable(); // Round, Oval
            $table->integer('total_count')->default(0);
            $table->decimal('total_weight', 8, 3)->default(0); // cts

            // Quality Grades
            $table->string('clarity')->nullable(); // SI, VVS
            $table->string('color')->nullable(); // IJ, GH
            $table->string('setting_type')->nullable(); // Prong

            $table->decimal('stone_price', 10, 2)->default(0); // Cost contribution

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_stones');
    }
};
