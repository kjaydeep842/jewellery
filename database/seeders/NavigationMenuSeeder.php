<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['title' => 'New Arrivals', 'route_name' => 'page.new-arrivals', 'order' => 1],
            ['title' => 'Best Seller', 'route_name' => 'page.best-seller', 'order' => 2],
            ['title' => '18KT Jewellery', 'route_name' => 'page.18kt', 'order' => 3],
            ['title' => 'Tattsvi\'s Favourite', 'route_name' => 'page.tattsvisfavourite', 'order' => 4],
            ['title' => 'Ready To Stock', 'route_name' => 'page.readytostock', 'order' => 5],
            ['title' => 'Contact Us', 'route_name' => 'page.contact', 'order' => 6],
            ['title' => 'About Us', 'route_name' => 'page.about', 'order' => 7],
        ];

        foreach ($menus as $menu) {
            \App\Models\NavigationMenu::create($menu);
        }
    }
}
