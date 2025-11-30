<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['is_admin' => 1]))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials']);
    }
// public function login(Request $request)
// {
//     $credentials = $request->only('email', 'password');

//     // Step 1: Get user
//     $user = \App\Models\User::where('email', $credentials['email'])->first();

//     if (!$user) {
//         return back()->withErrors(['email' => 'User not found']);
//     }

//     // Step 2: Check if admin
//     if ($user->is_admin != 1) {
//         return back()->withErrors(['email' => 'Not an admin']);
//     }

//     // Step 3: Check password manually
//     if (!\Hash::check($credentials['password'], $user->password)) {
//         return back()->withErrors(['email' => 'Invalid password']);
//     }

//     // Step 4: Login with ADMIN guard
//     Auth::guard('admin')->login($user);

//     return redirect()->route('admin.dashboard');
// }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
