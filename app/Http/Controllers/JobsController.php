<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobsController extends Controller
{
    public function jobs() {
        $jobs = Job::all();
        return view("auth.jobs", compact('jobs'));
    }

    public function jobPost() {
        return view("job-post");
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'job_title' => 'required|string',
                'job_location' => 'required|string',
                'job_type' => 'required|string',
                'job_description' => 'required|string',
                'company' => 'required|string',
                'salary' => 'required|string',
                'link' => 'required|url', // Assuming the link is a URL
            ]);

            // Get the authenticated user's ID
            $userId = auth()->user()->id;

            // Create a new job instance
            $job = new Job;
            $job->user_id = $userId; // Assign the user ID to the user_id column
            $job->job_title = $request->job_title;
            $job->job_location = $request->job_location;
            $job->job_type = $request->job_type;
            $job->job_description = $request->job_description;
            $job->company = $request->company;
            $job->salary = $request->salary;
            $job->link = $request->link;
            $job->save();

            return redirect()->back()->with('success', 'Job details saved successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Log and display the exception message
        }
    }

    public function update(Request $request, Job $job)
    {
        $job = Job::find($job->id);
        $job->update($request->all());
        
        
        return redirect()->route('jobs');
        // return dd($job);
            
        
    }

    public function show(Job $job)
    {
        return view('popups.update-job', compact('job'));
    }

    public function deleteJob($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs')->with('success', 'Job deleted successfully.');
    }

}
