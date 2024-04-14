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

    // Custom error messages
    $messages = [
        'username.required' => 'Please enter your username.',
        'password.required' => 'Please enter your password.',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules, $messages);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Check if the user exists in the database
    $user = User::where('username', $request->username)->first();
    if (!$user) {
        return redirect()->back()->withErrors(['message' => 'Invalid username or password.'])->withInput();
    }
    
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);
    
    // Attempt to authenticate the user
    $credentials = $request->only('username', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
            if (!$user->is_email_verified) {
                Auth::logout(); // Log out the user
                return redirect()->back()->withErrors(['message' => 'Your email is not verified. Please verify your email to log in.'])->withInput();
            }
        // Authentication successful
        return redirect()->intended('/dashboard'); // Redirect to the intended page after login
    }

    // Authentication failed
    return redirect()->back()->withErrors(['message' => 'Invalid username or password.'])->withInput();
}
}
