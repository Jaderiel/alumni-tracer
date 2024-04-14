<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $token = Str::random(60);
        // Validate the incoming request data
        $request->validate([
            'user_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'course' => 'required',
            'batch' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create and save the new user
        $user = User::create([
            'user_type' => $request->user_type,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'course' => $request->course,
            'batch' => $request->batch,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        // Redirect the user after successful registration
        return redirect(url('/login'))->with('success', 'Registration successful! You can now sign in.');

        // Generate a verification token
        $verificationUrl = route('verify.email', ['token' => $token]);

        Mail::to($request->input('email'))->send(new VerifyEmail($verificationUrl));

    }
}
