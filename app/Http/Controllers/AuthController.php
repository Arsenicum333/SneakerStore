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
        return view('sign-in');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Wrong email or password'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('profile'));
    }

    public function showRegister()
    {
        return view('log-in');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dob_day' => ['required', 'integer', 'min:1', 'max:31'],
            'dob_month' => ['required', 'integer', 'min:1', 'max:12'],
            'dob_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        ]);

        $dateOfBirth = sprintf('%04d-%02d-%02d', $request->dob_year, $request->dob_month, $request->dob_day);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'date_of_birth' => $dateOfBirth,
        ]);

        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $request->session()->regenerate();

        return redirect()->route('profile');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
