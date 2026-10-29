<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Check the email and password
    public function login(Request $request)
    {
        // 1. Validate the form data
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Auth::attempt finds the user by email, hashes the typed password
        //    and compares it with the stored hash. It starts the session on success.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // protects against session fixation
            return redirect()->intended(route('dashboard'))
                ->with('success', 'Welcome back, ' . Auth::user()->name . '.');
        }

        // 3. Wrong details: go back with an error message
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'The email or password is incorrect.');
    }

    // Show the register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Create a new user and log them in
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']), // never store plain text
        ]);

        // Later: $user->assignRole('student'); once the roles package is installed.

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Your account has been created.');
    }

    // End the session
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();       // destroy the session
        $request->session()->regenerateToken();  // new CSRF token

        return redirect()->route('login')
            ->with('success', 'You have been signed out.');
    }
}