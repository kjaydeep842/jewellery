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
        Schema::table('products', function (Blueprint $table) {
            // Basic Info (some might exist)
            if (!Schema::hasColumn('products', 'material')) {
                $table->string('material')->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'weight')) {
                $table->decimal('weight', 10, 3)->nullable()->after('material'); // Net/Gross Weight
            }
            if (!Schema::hasColumn('products', 'metal_color_id')) {
                $table->foreignId('metal_color_id')->nullable()->constrained('metal_colors')->nullOnDelete()->after('metal_type');
            }

            // Diamond Details
            if (!Schema::hasColumn('products', 'diamond_type')) {
                $table->string('diamond_type')->nullable(); // Natural, Lab Grown
            }
            if (!Schema::hasColumn('products', 'diamond_shape_id')) {
                $table->foreignId('diamond_shape_id')->nullable()->constrained('shapes')->nullOnDelete();
            }
            if (!Schema::hasColumn('products', 'diamond_color')) {
                $table->string('diamond_color')->nullable();
            }
            if (!Schema::hasColumn('products', 'diamond_clarity')) {
                $table->string('diamond_clarity')->nullable();
            }
            if (!Schema::hasColumn('products', 'diamond_carat')) {
                $table->decimal('diamond_carat', 8, 3)->nullable();
            }
            if (!Schema::hasColumn('products', 'diamond_count')) {
                $table->integer('diamond_count')->nullable();
            }
            if (!Schema::hasColumn('products', 'diamond_weight')) {
                $table->decimal('diamond_weight', 8, 3)->nullable();
            }
            if (!Schema::hasColumn('products', 'diamond_price')) {
                $table->decimal('diamond_price', 12, 2)->nullable();
            }

            // Price Breakup
            if (!Schema::hasColumn('products', 'price_gold_value')) {
                $table->decimal('price_gold_value', 12, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'price_diamond_value')) {
                $table->decimal('price_diamond_value', 12, 2)->nullable();
            }
            // making_charges already exists from previous migration likely, if not add it
            if (!Schema::hasColumn('products', 'making_charges')) {
                $table->decimal('making_charges', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('products', 'price_gst')) {
                $table->decimal('price_gst', 12, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'price_subtotal')) {
                $table->decimal('price_subtotal', 12, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'price_grand_total')) {
                $table->decimal('price_grand_total', 12, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'selling_price')) {
                $table->decimal('selling_price', 12, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'discount_price')) {
                $table->decimal('discount_price', 12, 2)->nullable();
            }

            // Re-adding stock if missing (User erased it maybe?)
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['metal_color_id']);
            $table->dropForeign(['diamond_shape_id']);
            $table->dropColumn([
                'material',
                'weight',
                'metal_color_id',
                'diamond_type',
                'diamond_shape_id',
                'diamond_color',
                'diamond_clarity',
                'diamond_carat',
                'diamond_count',
                'diamond_weight',
                'diamond_price',
                'price_gold_value',
                'price_diamond_value',
                'making_charges',
                'price_gst',
                'price_subtotal',
                'price_grand_total',
                'selling_price',
                'discount_price',
                'stock'
            ]);
        });
    }
};
