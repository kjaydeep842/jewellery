<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\OurStory;
use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Your message has been sent successfully!');
    }

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
        $ourStories = OurStory::where('status', 1)
            ->where('type', 'content')
            ->get();

        $features = OurStory::where('status', 1)
            ->where('type', 'feature')
            ->get();

        return view('frontend.pages.about', compact('ourStories', 'features'));
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
        $blogs = Blog::where('status', 1)->latest()->paginate(9);
        return view('frontend.pages.blog', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', true)->firstOrFail();
        $recentBlogs = Blog::where('id', '!=', $blog->id)->where('status', true)->latest()->take(3)->get();
        return view('frontend.pages.blog_details', compact('blog', 'recentBlogs'));
    }

    public function terms()
    {
        $content = \App\Models\LegalPage::where('type', 'terms')->where('status', true)->first();
        return view('frontend.pages.terms', compact('content'));
    }

    public function privacy()
    {
        $content = \App\Models\LegalPage::where('type', 'privacy')->where('status', true)->first();
        return view('frontend.pages.privacy', compact('content'));
    }
}
