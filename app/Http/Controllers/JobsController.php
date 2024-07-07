<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Rules\ValidSalaries;
use Illuminate\Validation\Rule;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    private function logActivity($action, $description)
    {
        ActivityLogHelper::log(Auth::id(), $action, $description);
    }

    public function jobs() {
        $jobs = Job::where('is_approved', true)
        ->where('inactive', false)
        ->get();

        return view("auth.jobs", compact('jobs'));
    }

    public function jobPost(Request $request) {
        $jobLocation = $request->input('job_location');
        return view('job-post', compact('jobLocation'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_title' => 'required|string',
            'job_location' => 'required|string',
            'job_type' => ['required', 'string', Rule::in(['full-time', 'part-time'])],
            'job_description' => 'required|string|max:65535',
            'company' => 'required|string',
            'salary' => ['required', new ValidSalaries],
            'link' => 'required|url',
        ]);

        // Truncate job description if it exceeds the maximum length
        $jobDescription = substr($validatedData['job_description'], 0, 65535);

        $userId = auth()->user()->id;
        $userType = auth()->user()->user_type;

        $job = new Job;
        $job->user_id = $userId;
        $job->job_title = $validatedData['job_title'];
        $job->job_location = $validatedData['job_location'];
        $job->job_type = $validatedData['job_type'];
        $job->job_description = $jobDescription;
        $job->company = $validatedData['company'];
        $job->salary = $validatedData['salary'];
        $job->link = $validatedData['link'];

        // Set is_approved to true if user_type is Super Admin or Admin
        if ($userType === 'Super Admin' || $userType === 'Admin') {
            $job->is_approved = true;
            $job->save();

            // Log the activity
            $this->logActivity('Job Created', "Job titled '{$job->job_title}' created and approved by User ID: $userId");

            return redirect()->back()->with('success', 'Job details saved successfully!');
        }

        $job->save();

        // Log the activity
        $this->logActivity('Job Created', "Job titled '{$job->job_title}' created by User ID: $userId and awaiting approval");

        return redirect()->back()->with('success', 'Job details saved successfully. Please wait for approval');
    }

    public function update(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'job_title' => 'required|string',
            'job_location' => 'required|string',
            'job_type' => ['required', 'string', Rule::in(['full-time', 'part-time'])],
            'job_description' => 'required|string|max:65535',
            'company' => 'required|string',
            'salary' => ['required', new ValidSalaries],
            'link' => 'required|url',
        ]);

        $job->update($validatedData);

        // Log the activity
        $this->logActivity('Job Updated', "Job ID: {$job->id} titled '{$job->job_title}' updated by User ID: " . auth()->user()->id);

        return redirect()->route('jobs')->with('success', 'Job details saved successfully.');
    }

    public function show(Job $job)
    {
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType !== 'Super Admin' && $currentUserType !== 'Admin' && $job->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to view this job post.');
        }
        return view('popups.update-job', compact('job'));
    }

    public function deleteJob($id)
    {
        $job = Job::findOrFail($id);
        $currentUserType = auth()->user()->user_type;
        if ($currentUserType !== 'Super Admin' && $currentUserType !== 'Admin' && $job->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this job post.');
        }

        // Log the activity
        $this->logActivity('Job archived', "Job ID: {$job->id} titled '{$job->job_title}' archived by User ID: " . auth()->user()->id);

        $job->inactive = true;
        $job->save();

        return redirect()->route('jobs')->with('success', 'Job archived successfully.');
    }

    public function showLocationComponent() {
        return view('components.job-location');
    }

    public function storeLocation(Request $request)
    {
        $jobLocation = $request->input('job_location');
        return redirect()->route('job-post.show', ['job_location' => $jobLocation]);
    }

    public function showJobPost(Request $request)
    {
        $jobLocation = $request->input('job_location');
        return view('job-post', compact('jobLocation'));
    }
}
