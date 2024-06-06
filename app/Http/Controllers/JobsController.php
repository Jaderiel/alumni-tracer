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
    try {
        $request->validate([
            'job_title' => 'required|string',
            'job_location' => 'required|string',
            'job_type' => 'required|string',
            'job_description' => 'required|string|max:65535',
            'company' => 'required|string',
            'salary' => 'required|string',
            'link' => 'required|url',
        ]);

        // Truncate job description if it exceeds the maximum length
        $jobDescription = substr($request->job_description, 0, 65535);

        $userId = auth()->user()->id;

        $job = new Job;
        $job->user_id = $userId;
        $job->job_title = $request->job_title;
        $job->job_location = $request->job_location;
        $job->job_type = $request->job_type;
        $job->job_description = $jobDescription; // Assign truncated description
        $job->company = $request->company;
        $job->salary = $request->salary;
        $job->link = $request->link;
        $job->save();

        return redirect()->back()->with('success', 'Job details saved successfully. Please wait for approval');
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
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
