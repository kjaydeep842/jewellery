<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt(array_merge($credentials, ['is_admin' => 1]))) {
    //         return redirect()->route('admin.dashboard');
    //     }

    //     return back()->withErrors(['email' => 'Invalid admin credentials']);
    // }
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Check if user exists
    $user = \App\Models\User::where('email', $credentials['email'])->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Invalid admin credentials']);
    }

    // Check password using Laravel's Hash::check
    if (!\Hash::check($credentials['password'], $user->password)) {
        return back()->withErrors(['email' => 'Invalid admin credentials']);
    }

    // Check admin flag
    if ($user->is_admin != 1) {
        return back()->withErrors(['email' => 'You are not authorized as admin']);
    }

    // Log user in
    Auth::login($user);

    return redirect()->route('admin.dashboard');
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
