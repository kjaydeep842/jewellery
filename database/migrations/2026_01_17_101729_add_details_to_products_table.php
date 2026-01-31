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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('making_charges', 10, 2)->default(0)->after('price');
            $table->decimal('tax_rate', 5, 2)->default(3.00)->after('making_charges');

            // Core Specs common to variants
            $table->string('metal_type')->nullable()->after('description'); // e.g. Gold, Platinum
            $table->string('metal_purity')->nullable()->after('metal_type'); // e.g. 18k, 22k
            $table->string('gender')->nullable()->after('metal_purity'); // e.g. Women
            $table->string('occasion')->nullable()->after('gender'); // e.g. Engagement
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['making_charges', 'tax_rate', 'metal_type', 'metal_purity', 'gender', 'occasion']);
        });
    }
};
