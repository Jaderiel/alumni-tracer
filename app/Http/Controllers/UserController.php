<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ApprovalRequest;
use App\Models\DegreeStatus;
use Illuminate\Http\Request;
use App\Rules\NotSuperAdmin;
use App\Rules\ValidIndustryOption;
use App\Rules\ValidAnnualSalaryOption;
use App\Rules\ValidDegrees;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private function logActivity($userId, $action, $description)
    {
        ActivityLogHelper::log($userId, $action, $description);
    }

    public function updateVerification(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->is_email_verified = true;
        $user->save();

        // Log activity
        $this->logActivity(Auth::id(), 'Verification Updated', "User verification status updated for {$user->first_name} {$user->last_name}");

        return redirect()->back()->with('success', 'User verification status updated successfully');
    }

    public function showVerifiedAlumni()
    {
        $verifiedAlumni = User::where('user_type', 'Alumni')
                            ->where('is_email_verified', true)
                            ->paginate(20);

        return view('auth.alumni-list', ['verifiedAlumni' => $verifiedAlumni]);
    }

    public function editProfile()
    {
        $user = auth()->user();
        $userId = $user->id;
        $degrees = $user->degrees()->get();

        return view('profile.edit', compact('user', 'userId', 'degrees'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
    
        $request->validate([
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
            'is_owned_business' => 'required|in:yes,no',
            'employment_status' => 'required|in:employed,unemployed',
            'job_title' => ['nullable', new NotSuperAdmin],
            'company_name' => ['nullable', new NotSuperAdmin],
            'industry' => ['nullable', new ValidIndustryOption],
            'date_of_employment' => 'nullable|date',
            'annual_salary' => ['nullable', new ValidAnnualSalaryOption],
            'user_type' => 'nullable|in:'.$user->user_type,
            'degree' => ['nullable', new ValidDegrees],
            'school' => 'nullable',
            'is_ongoing' => 'nullable|boolean',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',  // Add this line
            'email' => 'required|email',
        ]);
    
        $profilePicUrl = $user->profile_pic;
    
        // Update profile picture if provided
        if ($request->hasFile('profile_pic')) {
            // Handle profile picture upload
            $image = $request->file('profile_pic');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $profilePicUrl = 'images/'.$imageName;
            $user->profile_pic = $profilePicUrl;
            \Log::info('Profile picture updated: ' . $profilePicUrl);
        } else {
            \Log::info('No profile picture uploaded.');
        }
    
        // Create approval requests for first_name, middle_name, and last_name
        $nameFields = ['first_name', 'middle_name', 'last_name'];
        foreach ($nameFields as $field) {
            if ($request->filled($field) && $request->input($field) !== $user->$field) {
                ApprovalRequest::create([
                    'user_id' => $user->id,
                    'field' => $field,
                    'old_value' => $user->$field ?? 'N/A', // Use 'N/A' or another default value if old_value is null
                    'new_value' => $request->input($field),
                    'approved' => null
                ]);
            }
        }
    
        // Update user profile data excluding profile_pic, user_type, degree, school, is_ongoing, first_name, middle_name, and last_name
        $user->update($request->except(['profile_pic', 'user_type', 'degree', 'school', 'is_ongoing', 'first_name', 'middle_name', 'last_name']));
    
        // Handle degree status update if degree and school are provided
        if ($request->filled('degree') && $request->filled('school')) {
            $degreeStatus = $user->degreeStatus;
    
            if (!$degreeStatus) {
                $degreeStatus = new DegreeStatus();
                $degreeStatus->user_id = $user->id;
            }
    
            $degreeStatus->degree = $request->input('degree');
            $degreeStatus->school = $request->input('school');
            $degreeStatus->is_ongoing = $request->input('is_ongoing', false);
    
            $degreeStatus->save();
        } elseif ($user->degreeStatus) {
            $user->degreeStatus->delete();
        }
    
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
    
        $this->logActivity(Auth::id(), 'Profile Updated', "Profile updated for {$user->first_name} {$user->last_name}");
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    

public function approveRequest($id, $approval)
{
    $approvalRequest = ApprovalRequest::findOrFail($id);

    if ($approval === 'approve') {
        $user = User::find($approvalRequest->user_id);
        $user->update([$approvalRequest->field => $approvalRequest->new_value]);
        $approvalRequest->approved = true;
    } elseif ($approval === 'reject') {
        $approvalRequest->approved = false;
    }

    $approvalRequest->save();

    return redirect()->back()->with('success', 'Request processed successfully.');
}

public function showApprovalRequests()
{
    $approvalRequests = ApprovalRequest::where('approved', null)->with('user')->get();
    return view('approval-requests', compact('approvalRequests'));
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

        // Log activity
        $this->logActivity(Auth::id(), 'User Deleted', "Deleted user {$user->first_name} {$user->last_name}");

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

        // Log the user deletion activity
        $description = 'Deleted user: ' . $user->first_name . ' ' . $user->last_name;

        // If the user is trying to delete their own account
        if ($user->id === auth()->user()->id) {
            // Delete the user's account
            $user->delete();
            $this->logActivity(Auth::id(), 'Deleted Own Account', $description);
            return redirect()->route('login.show')->with('success', 'Your account has been deleted.');
        }

        // Delete the user's account
        $user->delete();
        $this->logActivity(Auth::id(), 'Deleted User Account', $description);

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

        // Log the activity
        $this->logActivity(auth()->id(), 'Degree Status Created', "Degree status created for user ID: " . auth()->id());

        // Redirect back or return a response indicating success
        return redirect()->back()->with('success', 'Degree status saved successfully!');
    }

    public function destroyDegree($id)
    {
        $degree = DegreeStatus::find($id);

        if ($degree) {
            $degree->delete();

            // Log the activity
            $this->logActivity(auth()->id(), 'Degree Status Deleted', "Deleted degree status with ID: {$id}");

            return response()->json(['message' => 'Degree deleted successfully']);
        } else {
            return response()->json(['message' => 'Degree not found'], 404);
        }
    }

}
