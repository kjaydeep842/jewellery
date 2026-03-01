<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

foreach (Product::with('images')->latest()->take(5)->get() as $p) {
    echo "P: " . $p->name . " - IMG: " . ($p->image ?: 'N/A') . "\n";
    foreach ($p->images as $i) {
        echo " - " . $i->image_path . "\n";
    }
}
