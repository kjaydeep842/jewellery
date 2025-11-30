<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ProductFrontendController extends Controller
{
    public function details()
    {
        return view('front.products.index'); 
        // This loads: resources/views/front/products/index.blade.php
    }
}
