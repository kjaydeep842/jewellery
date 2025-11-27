<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tag_id');

            $table->timestamps();

            // Foreign Keys with explicit names
            $table->foreign('product_id', 'fk_product_tag_product')
                  ->references('id')->on('products')
                  ->onDelete('cascade');

            $table->foreign('tag_id', 'fk_product_tag_tag')
                  ->references('id')->on('tags')
                  ->onDelete('cascade');

            // Prevent duplicates
            $table->unique(['product_id', 'tag_id'], 'uniq_product_tag');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_tag');
    }
};
