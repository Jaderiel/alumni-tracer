<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountApproved;
use App\Mail\AccountCreated;
use App\Models\Gallery;
use App\Models\Job;
use App\Models\ActivityLog;


class AdminController extends Controller
{
    public function index() {
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType === 'Alumni') {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }

        $unverifiedUsers = User::where('is_email_verified', false)
                                ->whereNotNull('email_verified_at')
                                ->get();
        $gallery = Gallery::where('is_approved', false)->get();
        $jobs = Job::where('is_approved', false)->get();
        $superAdmin = User::where('user_type', "Super Admin")->get();
        $admin = User::where('user_type', "Admin")->get();
        $programHead = User::where('user_type', "Program Head")->get();
        $alumniOfficer = User::where('user_type', "Alumni Officer")->get();
        $logs = ActivityLog::with('user')->latest()->paginate(20);

        return view('auth.administration', compact('unverifiedUsers', 'gallery', 'jobs', 'superAdmin', 'admin', 'programHead', 'alumniOfficer', 'logs'));
    }

    public function approveUser($userId)
    {
        // Check if the authenticated user is either an Admin or a Super Admin
        if (!in_array(auth()->user()->user_type, ['Admin', 'Super Admin'])) {
            return redirect()->back()->with('error', 'You are not authorized to approve users.');
        }

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


    public function createAccount(Request $request) {
        if (auth()->user()->user_type !== 'Super Admin') {
            return redirect()->back()->with('error', 'You are not authorized to create user accounts.');
        }
        // Define validation rules
        $rules = [
            'user_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    
        // If user_type is Alumni, make course required
        if ($request->input('user_type') === 'Alumni') {
            $rules['course'] = 'required';
            $rules['batch'] = 'required';
        } else {
            // If user_type is not Alumni, set course and batch to 'N/A'
            $request->merge(['course' => 'N/A']);
            $request->merge(['batch' => 'N/A']);
        }
    
        // Validate the request
        $request->validate($rules);
    
        // Create user
        $user = User::create([
            'user_type' => $request->user_type,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'course' => $request->course, 
            'batch' => $request->batch,
            'is_email_verified' => true,
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        Mail::to($user->email)->send(new AccountCreated());
    
        return redirect()->back()->with('success', 'User account created successfully.');
    }

    public function approveGallery($id)
    {
        $currentUserType = auth()->user()->user_type;
        if (!in_array($currentUserType, ['Admin', 'Super Admin'])) {
            return redirect()->back()->with('error', 'You are not authorized to approve gallery posts.');
        }
        // Find the user by ID
        $gallery = Gallery::findOrFail($id);

        // Update the user's verification status
        $gallery->is_approved = true;
        $gallery->save();

        // Send the approval email
        // Mail::to($user->email)->send(new AccountApproved());

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Gallery post approved successfully.');
    }
    
    public function deleteGallery($id)
    {
        $currentUserType = auth()->user()->user_type;
        if (!in_array($currentUserType, ['Admin', 'Super Admin'])) {
            return redirect()->back()->with('error', 'You are not authorized to delete gallery posts.');
        }
        // Find the gallery item by ID
        $gallery = Gallery::findOrFail($id);

        // Delete the gallery item
        $gallery->delete();

        return redirect()->back()->with('success', 'Gallery post deleted successfully.');
    }

    public function approveJob($id)
    {
        $currentUserType = auth()->user()->user_type;
        if (!in_array($currentUserType, ['Admin', 'Super Admin'])) {
            return redirect()->back()->with('error', 'You are not authorized to approve job posts.');
        }
        // Find the user by ID
        $jobs = Job::findOrFail($id);

        // Update the user's verification status
        $jobs->is_approved = true;
        $jobs->save();

        // Send the approval email
        // Mail::to($user->email)->send(new AccountApproved());

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Job post approved successfully.');
    }

    public function deleteJob($id)
    {
        $currentUserType = auth()->user()->user_type;
        if (!in_array($currentUserType, ['Admin', 'Super Admin'])) {
            return redirect()->back()->with('error', 'You are not authorized to delete job posts.');
        }
        // Find the gallery item by ID
        $jobs = Job::findOrFail($id);

        // Delete the gallery item
        $jobs->delete();

        return redirect()->back()->with('success', 'Job post deleted successfully.');
    }

    // UserController.php
    public function updateRole(Request $request)
    {
        if (auth()->user()->user_type !== 'Super Admin') {
            return redirect()->back()->with('error', 'You are not authorized to update user roles.');
        }
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_role' => 'required|in:Super Admin,Admin,Program Head,Alumni Officer',
        ]);

        $user = User::find($request->user_id);
        $user->user_type = $request->user_role;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function deleteAdmin($id)
    {
        if (auth()->user()->user_type !== 'Super Admin') {
            return redirect()->back()->with('error', 'You are not authorized to delete user.');
        }

        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }


}
