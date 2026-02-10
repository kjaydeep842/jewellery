<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function bestSeller()
    {
        return view('frontend.pages.best-seller');
    }

    public function readyToStock()
    {
        return view('frontend.pages.ready-to-stock');
    }

    public function buyItAgain()
    {
        return view('frontend.pages.buy-it-again');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function exhibition()
    {
        return view('frontend.pages.exhibition');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function returnExchange()
    {
        return view('frontend.pages.return_exchange');
    }

    public function blog()
    {
        return view('frontend.pages.blog');
    }


}
