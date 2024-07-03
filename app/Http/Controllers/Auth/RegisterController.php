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
use App\Http\Requests\PasswordRequest;
use App\Rules\UniqueUser;


class RegisterController extends Controller
{
    public function register(PasswordRequest $request)
    {
        $validatedData = $request->validated();

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
        return redirect()->back()->with('error', 'This account is already verified.');
    }

    $verificationCode = Str::random(6);
    $user->email_verification_code = $verificationCode;
    $user->save();

    Mail::to($user->email)->send(new VerificationCode($verificationCode));

    return redirect()->back()->with('success', 'Verification code resent successfully! Please check your email.');
}

}
