<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail(Request $request, $token){
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            // Mark the user as verified
            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();

            // Redirect to login page with success message
            return redirect()->route('login')->with('success', 'Your email has been verified. You can now log in.');
        } else {
            // Redirect to registration page with error message
            return redirect()->route('register')->with('error', 'Invalid verification token.');
        }
    }
}
