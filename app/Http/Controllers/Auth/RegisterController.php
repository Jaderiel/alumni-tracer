<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Rules\ValidCourses;
use App\Rules\ValidBatches;
use Illuminate\Auth\Events\Registered;
use App\Mail\VerificationCode;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'course' => ['required', new ValidCourses],
            'batch' => ['required', new ValidBatches],
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $verificationCode = Str::random(6);

        $user = User::create([
            'user_type' => 'Alumni',
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'course' => $request->course,
            'batch' => $request->batch,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email_verification_code' => $verificationCode,
        ]);

        // Send verification code to user's email
        Mail::to($user->email)->send(new VerificationCode($verificationCode));

        return response()->json(['success' => true, 'redirect_url' => route('ver.show')]);
    }

    public function resendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->is_email_verified) {
            return response()->json(['error' => 'This account is already verified.'], 400);
        }

        $verificationCode = Str::random(6);
        $user->email_verification_code = $verificationCode;
        $user->save();

        Mail::to($user->email)->send(new VerificationCode($verificationCode));

        return response()->json(['success' => 'Verification code resent successfully! Please check your email.']);
    }
}
