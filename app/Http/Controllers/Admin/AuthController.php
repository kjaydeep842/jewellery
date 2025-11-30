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

    // First try authentication (email + password)
    if (Auth::validate($credentials)) {

        $user = Auth::getLastAttempted();

        // Now check if this user is admin
        if ($user->is_admin == 1) {
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'You are not authorized as admin']);
    }

    return back()->withErrors(['email' => 'Invalid admin credentials']);
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
