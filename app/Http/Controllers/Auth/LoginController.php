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
    $rules = [
        'username' => 'required|string',
        'password' => 'required|string',
    ];

    $messages = [
        'username.required' => 'Please enter your username.',
        'password.required' => 'Please enter your password.',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::where('username', $request->username)->first();
    if (!$user) {
        return redirect()->back()->withErrors(['message' => 'Invalid username or password.'])->withInput();
    }
    
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('username', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
            if (!$user->is_email_verified) {
                Auth::logout();
                return redirect()->back()->withErrors(['message' => 'Your email is not verified. Please wait for the admin to verify your email'])->withInput();
            }

        return redirect()->intended('/dashboard');
    }

    return redirect()->back()->withErrors(['message' => 'Invalid username or password.'])->withInput();
}

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
