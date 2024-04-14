<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view("auth.login");
    }

    public function dashboard() {
        return view("auth.dashboard");
    }

    public function approvals() {
        return view("auth.approvals");
    }

    public function alumniList() {
        return view("auth.alumni-list");
    }
}
