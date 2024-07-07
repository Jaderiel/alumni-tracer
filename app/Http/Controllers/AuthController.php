<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        return view("auth.login");
    }

    public function mobileLogin() {
        return view("auth.mobile-login");
    }

    public function mobileSignUp() {
        return view("auth.mobile-signup");
    }

    public function dashboard() {
        $verifiedAlumniCount = User::where('is_email_verified', true)
            ->where('user_type', 'Alumni')
            ->count();
    
        // Pass the $verifiedAlumniCount and $announcements variables to the view
        return view('auth.dashboard', compact('verifiedAlumniCount'));
    }
    

    public function approvals() {
        return view("auth.approvals");
    }

    public function alumniList() {
        $verifiedAlumni = User::where('is_verified', true)
        ->where('inactive', false)
        ->paginate(10); // Fetch 10 alumni per page
        
        return view("auth.alumni-list", compact('verifiedAlumni'));
    }

    public function profile() {
        return view("auth.profile");
    }

    public function privNotice() {
        return view("auth.privacy-notice");
    }
}
