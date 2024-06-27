<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string',
    ], [
        'username.required' => 'Please enter your username.',
        'password.required' => 'Please enter your password.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput($request->except('password'));
    }

    $credentials = $request->only('username', 'password');

    if (!Auth::attempt($credentials)) {
        return redirect()->back()->withErrors(['message' => 'Invalid username or password.'])->withInput($request->except('password'));
    }

    $user = Auth::user();

    if (is_null($user->email_verified_at)) {
        Auth::logout();
        return redirect()->route('ver.show')->withErrors(['message' => 'Your email is not verified. Please check your email to verify your account.']);
    }

    if (!$user->is_email_verified) {
        Auth::logout();
        return redirect()->back()->withErrors(['message' => 'Your email is not verified. Please wait for the admin to verify your email'])->withInput($request->except('password'));
    }

    return redirect()->intended('/dashboard');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
