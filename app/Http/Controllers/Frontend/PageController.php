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
        $faqs = \App\Models\Faq::where('status', true)->get();
        return view('frontend.pages.faq', compact('faqs'));
    }

    public function returnExchange()
    {
        $policies = \App\Models\ReturnExchange::where('status', true)->get();
        return view('frontend.pages.return_exchange', compact('policies'));
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
        $page = \App\Models\LegalPage::where('type', 'terms')->where('status', true)->first();
        $content = $page ? $this->cleanLegalContent($page->content) : null;
        $title = $page->title ?? 'Terms & Conditions';
        return view('frontend.pages.terms', compact('content', 'title'));
    }

    public function privacy()
    {
        $page = \App\Models\LegalPage::where('type', 'privacy')->where('status', true)->first();
        $content = $page ? $this->cleanLegalContent($page->content) : null;
        $title = $page->title ?? 'Privacy Policy';
        return view('frontend.pages.privacy', compact('content', 'title'));
    }

    /**
     * Cleans up legal content that might have been uploaded as a full HTML doc
     * or accidentally escaped into a code block.
     */
    private function cleanLegalContent($content)
    {
        if (!$content)
            return null;

        // 1. If it looks like it was pasted into a visual editor and escaped
        if (str_contains($content, '&lt;!DOCTYPE') || str_contains($content, '&lt;html') || str_contains($content, '&lt;body')) {
            $content = htmlspecialchars_decode($content);
        }

        // 2. If it's wrapped in a <pre> or <code> block by the editor
        if (preg_match('/^<pre.*><code.*>(.*)<\/code><\/pre>$/is', trim($content), $matches)) {
            $content = $matches[1];
        }

        // 3. Extract body content if it's a full document
        if (preg_match('/<body[^>]*>(.*)<\/body>/is', $content, $matches)) {
            $content = $matches[1];
        } else {
            // Strip out head/html tags if body wasn't found but they exist
            $content = preg_replace('/<html[^>]*>|<head[^>]*>|.*<\/head>|<\/html>|<!DOCTYPE[^>]*>/is', '', $content);
        }

        return trim($content);
    }
}
