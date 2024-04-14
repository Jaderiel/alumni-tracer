<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApprovalsController extends Controller
{
    public function index()
    {
        $unverifiedUsers = User::where('is_email_verified', false)->get();
        return view('auth.approvals', ['unverifiedUsers' => $unverifiedUsers]);
    }
}
