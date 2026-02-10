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
            // Master Relations
            if (!Schema::hasColumn('products', 'brand_id')) {
                $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete()->after('category_id');
            }
            if (!Schema::hasColumn('products', 'unit_id')) {
                $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete()->after('brand_id');
            }
            if (!Schema::hasColumn('products', 'color_id')) {
                $table->foreignId('color_id')->nullable()->constrained('colors')->nullOnDelete()->after('unit_id'); // Generic Color
            }

            // Modern Features
            if (!Schema::hasColumn('products', 'short_description')) {
                $table->text('short_description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('products', 'video_url')) {
                $table->string('video_url')->nullable()->after('image');
            }

            // Flags
            if (!Schema::hasColumn('products', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('products', 'is_new')) {
                $table->boolean('is_new')->default(false);
            }
            if (!Schema::hasColumn('products', 'is_bestseller')) {
                $table->boolean('is_bestseller')->default(false);
            }

            // SEO (if not exists)
            if (!Schema::hasColumn('products', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('products', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['color_id']);
            $table->dropColumn([
                'brand_id',
                'unit_id',
                'color_id',
                'short_description',
                'video_url',
                'is_featured',
                'is_new',
                'is_bestseller',
                'meta_title',
                'meta_description',
                'meta_keywords'
            ]);
        });
    }
};
