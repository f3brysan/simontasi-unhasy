<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
         // Display the login form
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        // Validate email and password fields
        $request->validate([
            'no_induk'    => ['required'],
            'password' => ['required'],
        ]);

        // Define the credentials for user authentication
        $credentials = $request->validate([
            'no_induk'    => ['required'],
            'password' => ['required'],
        ]);

        // Attempt user authentication
        if (Auth::attempt($credentials)) {
            // If authentication is successful, regenerate the session and
            // store the user information in the session
            $request->session()->regenerate();
            $user = auth()->user();
            // Redirect to the intended page with a success message
            return redirect()->intended('/')->with('success', 'Selamat Datang ' . $user->name ?? $user->email . ' .');
        }
        // Return to the previous page with an error message
        return back()->with('LoginError', 'Email atau Password Anda salah !');
    }

    public function logout(Request $request)
    {
        // Logout the user and invalidate the session
        Auth::logout();
        $request->session()->invalidate();
        // Regenerate the CSRF token for the next request
        $request->session()->regenerateToken();
        // Redirect to the login page
        return redirect('/login');
    }
}
