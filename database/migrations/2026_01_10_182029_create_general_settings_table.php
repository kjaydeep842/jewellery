<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('LuxeGems');
            $table->string('primary_color')->default('#ffbf00'); // Gold
            $table->string('secondary_color')->default('#000000'); // Black
            $table->string('font_family')->default('Cinzel');
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });

        // Insert default premium settings
        DB::table('general_settings')->insert([
            'site_name' => 'Tattsvi Gems',
            'primary_color' => '#ffbf00',
            'secondary_color' => '#000000',
            'font_family' => 'Cinzel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
