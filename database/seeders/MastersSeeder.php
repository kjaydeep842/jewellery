<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Metal;
use App\Models\MetalColor;
use App\Models\Shape;
use App\Models\DiamondQuality;

class MastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Metals
        $metals = ['Gold', 'Platinum', 'Silver', 'Rose Gold'];
        foreach ($metals as $metal) {
            Metal::firstOrCreate(['name' => $metal], ['status' => true]);
        }

        // Metal Colors
        $colors = [
            ['name' => 'Yellow Gold', 'code' => '#FFD700'],
            ['name' => 'White Gold', 'code' => '#E5E4E2'],
            ['name' => 'Rose Gold', 'code' => '#B76E79'],
        ];
        foreach ($colors as $color) {
            MetalColor::firstOrCreate(['name' => $color['name']], [
                'color_code' => $color['code'],
                'status' => true
            ]);
        }

        // Diamond Shapes
        $shapes = ['Round', 'Princess', 'Emerald', 'Oval', 'Pear', 'Marquise', 'Cushion', 'Asscher', 'Radiant', 'Heart'];
        foreach ($shapes as $shape) {
            Shape::firstOrCreate(['name' => $shape], [
                'image' => 'shapes/default.png',
                'status' => true
            ]);
        }

        // Diamond Qualities
        $qualities = ['VVS-EF', 'VS-GH', 'SI-IJ', 'I1-JK'];
        foreach ($qualities as $quality) {
            DiamondQuality::firstOrCreate(['name' => $quality], ['status' => true]);
        }
    }
}
