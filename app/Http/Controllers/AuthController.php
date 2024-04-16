<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        return view("auth.login");
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
        return view("auth.alumni-list");
    }

    public function profile() {
        return view("auth.profile");
    }
}
