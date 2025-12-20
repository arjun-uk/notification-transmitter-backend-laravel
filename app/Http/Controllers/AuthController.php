<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = Auth::guard('api')->login($user);

            // Store token in session if we want to use it in Blade easily without re-fetching
            // But usually we just pass it to the view.
            session(['api_token' => $token]);

            return redirect('/chat');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        $token = Auth::guard('api')->login($user);
        session(['api_token' => $token]);

        return redirect('/chat');
    }

    public function logout(Request $request)
    {
        // Revoke the token
        if (Auth::check()) {
            Auth::guard('api')->logout();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profile()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }
}
