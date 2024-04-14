<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            // Set is_email_verified to true
            $user->is_email_verified = true;
            $user->save();

            return redirect('/login')->with('success', 'Your email has been verified. You can now log in.');
        }

        return redirect('/login')->with('error', 'Invalid verification token.');
    }

    public function verify($token)
{
    // Find the user by verification token
    $user = User::where('verification_token', $token)->first();

    if ($user) {
        // Update is_email_verified to true
        $user->is_email_verified = true;
        $user->save();

        // Redirect the user to a page indicating successful verification
        return redirect()->route('verification.success');
    }

    // If the token is not found, redirect to an error page
    return redirect()->route('verification.error');
}
}
