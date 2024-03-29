<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // dd($credentials);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();            
            $user = auth()->user();                                     
            return redirect()->intended('/')->with('success', 'Selamat Datang '.$user->name ?? $user->email. ' .');
        }
        return back()->with('LoginError', 'Email atau Password Anda salah !');
    }
}
