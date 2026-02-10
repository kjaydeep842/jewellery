<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $contacts = Contact::latest()->get();
            return view('admin.contacts.index', compact('contacts'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to load contacts. ' . $e->getMessage()]);
        }
    }

    // Other methods are purposely left empty or return an error/redirect as per requirement
    // No create, edit, update, destroy for admin
}
