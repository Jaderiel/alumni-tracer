<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobsController extends Controller
{
    public function jobs() {
        $jobs = Job::where('is_approved', true)->get();
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
            'job_type' => 'required|string',
            'job_description' => 'required|string|max:65535',
            'company' => 'required|string',
            'salary' => 'required|string',
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
        }
    
        $job->save();
    
        return redirect()->back()->with('success', 'Job details saved successfully. Please wait for approval');
    }
    



    public function update(Request $request, Job $job)
    {
        $job = Job::find($job->id);
        $job->update($request->all());
        
        return redirect()->route('jobs');
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
            return redirect()->back()->with('error', 'You are not authorized to Delete this job post.');
        }
        $job->delete();

        return redirect()->route('jobs')->with('success', 'Job deleted successfully.');
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
