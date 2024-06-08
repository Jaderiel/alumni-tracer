<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\NotSuperAdmin;

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

        return view('profile.edit', compact('user', 'userId'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user(); 
    
        $request->validate([
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
            'is_owned_business' => 'required|in:yes,no',
            'employment_status' => 'required|in:employed,unemployed',
            'job_title' => ['nullable', new NotSuperAdmin],
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
    
        $user->update($request->except('profile_pic'));
    
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


}
