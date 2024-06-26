<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\PasswordChangedMail;
use Illuminate\Support\Facades\Mail;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('components.change-password');
    }

    public function updatePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:10',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
                'confirmed',
            ],
        ]);

        $user = auth()->user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect. Please try again.'])->withInput();
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        Mail::to($user->email)->send(new PasswordChangedMail());

        // Redirect with a success message
        return redirect()->route('change-password.show')->with('success', 'Password changed successfully.');
    }
}
