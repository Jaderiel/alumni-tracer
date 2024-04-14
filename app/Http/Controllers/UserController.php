<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateVerification(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Update the user verification status
        $user->is_email_verified = true;
        $user->save();

        return redirect()->back()->with('success', 'User verification status updated successfully');
    }
}
