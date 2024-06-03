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
        $user = auth()->user();
        $userId = $user->id; // Get the authenticated user
        
        // Ensure $user is passed to the view
        return view('profile.edit', compact('user', 'userId'));
    }

    public function updateProfile(Request $request)
{
    $user = auth()->user(); // Get the authenticated user

    // Validate request data
    $request->validate([
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        'is_owned_business' => 'required|in:yes,no',
        // Add other validation rules as needed
    ]);

    // Handle profile picture upload if a new file is uploaded
    if ($request->hasFile('profile_pic')) {
        $image = $request->file('profile_pic');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $profile_pic = 'images/'.$imageName;
        // Update profile_pic with the new file path
        $user->profile_pic = $profile_pic;
        \Log::info('Profile picture updated: ' . $profile_pic);
    } else {
        \Log::info('No profile picture uploaded.');
    }

    // Update the user with all request data except profile_pic
    $user->update($request->except('profile_pic'));

    // Update degree if present in the request
    if ($request->has('degree')) {
        $user->degree = $request->input('degree');
    }

    // Save the updated user
    $user->save();
    \Log::info('User updated: ' . $user);

    // Update employment data
    $employmentData = $request->only(['is_employed', 'date_of_first_employment', 'date_of_employment', 'industry', 'job_title', 'company_name', 'company_address', 'annual_salary']);

    if (isset($employmentData['industry'])) {
        if ($user->course === 'Bachelor of Science in Information Systems' && $employmentData['industry'] === 'IT Industry') {
            $employmentData['is_aligned_to_course'] = true;
        } elseif ($user->course === 'Bachelor of Arts in Broadcasting' && $employmentData['industry'] === 'Entertainment') {
            $employmentData['is_aligned_to_course'] = true;
        } elseif ($employmentData['industry'] === 'Finance' && $user->course === 'Bachelor of Science in Accountancy') {
            $employmentData['is_aligned_to_course'] = true;
        } elseif ($user->course === 'Bachelor of Science in Accounting Technology' && 
                ($employmentData['industry'] === 'Finance' || $employmentData['industry'] === 'IT Industry')) {
            $employmentData['is_aligned_to_course'] = true;
        } else {
            $employmentData['is_aligned_to_course'] = false;
        }                     
    }

    // Update or create employment data
    $employment = $user->employment()->updateOrCreate([], $employmentData);

    // Update the is_owned_business field
    $employment->is_owned_business = $request->input('is_owned_business') === 'yes';
    $employment->save();

    if ($user->employment) {
        $user->employment->update(['is_employed' => $request->employment_status === 'employed']);
    } else {
        // Create new UserEmployment if it doesn't exist
        $user->employment()->create(['is_employed' => $request->employment_status === 'unemployed']);
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

        return redirect()->route('login.show')->with('success', 'User deleted successfully.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

}
