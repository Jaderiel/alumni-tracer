<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Job;


class PostController extends Controller
{
    public function store(Request $request) {
    // Validate the incoming request
        $request->validate([
            'caption' => 'required|string',
            'media_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Initialize mediaUrl variable
        $mediaUrl = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $mediaUrl = 'images/'.$imageName;
        }

        // Create a new post instance
        $post = new Forum();
        $post->user_id = auth()->id(); // Assuming you are using Laravel's authentication
        $post->caption = $request->caption;
        $post->media_url = $mediaUrl;
        $post->save();

        // Redirect back or to a specific route
        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function index()
        {
            // Retrieve forum posts from the database
            $forumPosts = Forum::all();
            $eventCount = Event::all()->count();
            $jobCount = Job::all()->count();
            $announcements = Announcement::all();
            $verifiedAlumniCount = User::where('is_email_verified', true)
                ->where('user_type', 'Alumni')
                ->count();

            // Pass forum posts data to the view
            return view('auth.dashboard', ['forumPosts' => $forumPosts, 'verifiedAlumniCount' => $verifiedAlumniCount, 'announcements' => $announcements, 'eventCount' => $eventCount, 'jobCount' => $jobCount]);
        }

        public function update(Request $request, $id)
{
    // Retrieve the post by ID
    $post = Post::findOrFail($id);
    
    // Update the caption with the new value from the request
    $post->caption = $request->input('caption');
    
    // Save the updated post
    $post->save();
    
    // Optionally, return a response indicating success
    return response()->json(['message' => 'Post updated successfully']);
}

}
