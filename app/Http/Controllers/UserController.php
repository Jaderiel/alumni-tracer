<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DegreeStatus;
use Illuminate\Http\Request;
use App\Rules\NotSuperAdmin;
use App\Rules\ValidIndustryOption;
use App\Rules\ValidAnnualSalaryOption;

class UserController extends Controller
{
    public function updateVerification(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->is_email_verified = true;
        $user->save();

        return redirect()->back()->with('success', 'User verification status updated successfully');
    }

    public function showVerifiedAlumni()
    {
        $verifiedAlumni = User::where('user_type', 'Alumni')
                            ->where('is_email_verified', true)
                            ->paginate(20); // Remove the get() method

        return view('auth.alumni-list', ['verifiedAlumni' => $verifiedAlumni]);
    }

    public function editProfile()
    {
        $user = auth()->user();
        $userId = $user->id;
        $users = auth()->user();
        $degrees = $users->degrees()->get();

        return view('profile.edit', compact('user', 'userId', 'degrees'));
    }

    public function updateProfile(Request $request)
{
    $user = auth()->user(); 

    $validatedData = $request->validate([
        'degree' => 'required',
        'school' => 'required',
        'is_ongoing' => 'required|boolean', // Assuming it's a boolean value
    ]);

    // Save the data to the database
    $degreeStatus = new DegreeStatus();
    $degreeStatus->user_id = auth()->user()->id;
    $degreeStatus->degree = $request->degree;
    $degreeStatus->school = $request->school;
    $degreeStatus->is_ongoing = $request->is_ongoing;
    // You might also need to associate it with a user, assuming you have user authentication
    // $degreeStatus->user_id = auth()->user()->id;
    $degreeStatus->save();

    $request->validate([
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        'is_owned_business' => 'required|in:yes,no',
        'employment_status' => 'required|in:employed,unemployed',
        'job_title' => ['nullable', new NotSuperAdmin],
        'company_name' => ['nullable', new NotSuperAdmin],
        'industry' => ['nullable', new ValidIndustryOption],
        'date_of_employment' => 'nullable|date',
        'annual_salary' => ['nullable', new ValidAnnualSalaryOption],
        'user_type' => 'nullable|in:'.$user->user_type, // Validation for user_type
    ]);

    if ($request->hasFile('profile_pic')) {
        $image = $request->file('profile_pic');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $profile_pic = 'images/'.$imageName;
        $user->profile_pic = $profile_pic;
        \Log::info('Profile picture updated: ' . $profile_pic);
    } else {
        \Log::info('No profile picture uploaded.');
    }

    $user->update($request->except(['profile_pic', 'user_type'])); // Exclude user_type from update

    if ($request->has('degree')) {
        $user->degree = $request->input('degree');
    }

    $user->save();
    \Log::info('User updated: ' . $user);

    // Prepare employment data based on employment status
    $employmentData = [];
    if ($request->employment_status === 'unemployed') {
        $employmentData = [
            'job_title' => null,
            'company_name' => null,
            'industry' => null,
            'date_of_employment' => null,
            'annual_salary' => null,
            'company_address' => null,
            'is_employed' => false,
        ];
    } else {
        $employmentData = $request->only([
            'job_title',
            'company_name',
            'industry',
            'date_of_employment',
            'annual_salary',
            'company_address'
        ]);

        // Check alignment to course
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
        $employmentData['is_employed'] = true;
    }

    $employment = $user->employment()->updateOrCreate([], $employmentData);

    $employment->is_owned_business = $request->input('is_owned_business') === 'yes';
    $employment->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

    

    public function getUserEmployment($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $employment = $user->employment;

        return response()->json($employment);
    }

    public function showProfile()
    {
        $user = auth()->user(); 
        $userId = $user->id; 

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
        // Find the user by ID
        $user = User::findOrFail($id);

        // Check if the authenticated user is either an Admin or a Super Admin
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType !== 'Admin' && $currentUserType !== 'Super Admin') {
            // Prevent deletion of other users' accounts
            return redirect()->back()->with('error', 'You are not authorized to delete other users\' accounts.');
        }

        // If the user is trying to delete their own account
        if ($user->id === auth()->user()->id) {
            // Delete the user's account
            $user->delete();
            return redirect()->route('login.show')->with('success', 'Your account has been deleted.');
        }

        // Delete the user's account
        $user->delete();

        return redirect()->back()->with('success', 'User account deleted successfully.');
    }

    public function storeDegreeStatus(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'degree' => 'nullable|string',
            'school' => 'nullable|string',
            'is_ongoing' => 'nullable|boolean',
        ]);

        // Create a new DegreeStatus instance with the validated data
        $degreeStatus = new DegreeStatus();
        $degreeStatus->user_id = auth()->id(); // Assuming you're using authentication
        $degreeStatus->degree = $validatedData['degree'];
        $degreeStatus->school = $validatedData['school'];
        $degreeStatus->is_ongoing = $validatedData['is_ongoing'];
        $degreeStatus->save();

        // Redirect back or return a response indicating success
        return redirect()->back()->with('success', 'Degree status saved successfully!');
    }

    public function destroyDegree($id)
    {
        $degree = DegreeStatus::find($id);

        if ($degree) {
            $degree->delete();
            return response()->json(['message' => 'Degree deleted successfully']);
        } else {
            return response()->json(['message' => 'Degree not found'], 404);
        }
    }

}
