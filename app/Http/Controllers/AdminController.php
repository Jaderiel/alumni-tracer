<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\AccountApproved;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index() {
        $unverifiedUsers = User::where('is_email_verified', false)->get();
        return view('auth.administration', ['unverifiedUsers' => $unverifiedUsers]);
    }

    public function approveUser($userId)
    {
        // Find the user by ID
        $user = User::findOrFail($userId);

        // Update the user's verification status
        $user->is_email_verified = true;
        $user->save();

        // Send the approval email
        Mail::to($user->email)->send(new AccountApproved());

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'User account approved successfully.');
    }
}
