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

    public function showVerifiedAlumni()
    {
        $verifiedAlumni = User::where('user_type', 'Alumni')
                            ->where('is_email_verified', true)
                            ->get();

        return view('auth.alumni-list', ['verifiedAlumni' => $verifiedAlumni]);
    }

    public function editProfile()
    {
        $user = auth()->user(); // Get the authenticated user
        
        // Ensure $user is passed to the view
        return view('profile.edit', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        $user->update($request->all());
        if ($request->has('degree')) {
            $user->degree = $request->input('degree');
            $user->save();
        }

        $employmentData = $request->only(['is_employed', 'date_of_first_employment', 'date_of_employment', 'industry', 'job_title', 'company_name', 'company_address', 'annual_salary']);
        $user->employment()->updateOrCreate([], $employmentData);

        if ($user->employment) {
            $user->employment->update(['is_employed' => $request->employment_status === 'employed']);
        } else {
            // Create new UserEmployment if it doesn't exist
            $user->employment()->create(['is_employed' => $request->employment_status === 'Unemployed']);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function getUserEmployment($userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        if (!$user) {
            // Handle case where user is not found
            return response()->json(['error' => 'User not found'], 404);
        }

        // Retrieve the employment information associated with the user
        $employment = $user->employment;

        // Now you can work with the $employment object as needed
        return response()->json($employment);
    }

    public function showProfile()
    {
        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id; // Get the user ID

        // Pass the $user and $userId variables to the profile view
        return view('auth.profile', compact('user', 'userId'));
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('login')->with('success', 'User deleted successfully.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    
}
