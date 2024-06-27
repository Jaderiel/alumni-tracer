<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

    public function verify(Request $request) {
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->where('email_verification_code', $request->verification_code)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->email_verification_code = null; // Clear the verification code
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
        }

        return redirect()->back()->withErrors(['verification_code' => 'Invalid verification code']);
    }


    public function index() {
        return view("ver");
    }
}
