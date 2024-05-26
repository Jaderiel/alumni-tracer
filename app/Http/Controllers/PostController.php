<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Job;
use App\Models\Reaction;


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
        // Retrieve forum posts from the database, paginated with 5 posts per page
        $forumPosts = Forum::orderBy('created_at', 'desc')->paginate(5);
        
        // Retrieve counts for events, jobs, and verified alumni
        $eventCount = Event::count();
        $jobCount = Job::count();
        $verifiedAlumniCount = User::where('is_email_verified', true)
            ->where('user_type', 'Alumni')
            ->count();

        // Retrieve announcements
        $announcements = Announcement::all();


        // Pass data to the view
        return view('auth.dashboard', compact('forumPosts', 'verifiedAlumniCount', 'announcements', 'eventCount', 'jobCount',));
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

public function updatePost(Request $request) {
    $post = Forum::findOrFail($request->post_id);
    $post->caption = $request->edited_caption;
    $post->save();
    return redirect()->back()->with('success', 'Post updated successfully!');
}

public function delete(Request $request, $id) {
    // Find the post by ID
    $post = Forum::find($id);
    
    // Check if the post exists
    if (!$post) {
        return redirect()->back()->with('error', 'Post not found.');
    }
    
    // Attempt to delete the post
    try {
        $post->delete();
    } catch (\Exception $e) {
        // If an exception occurs during deletion, handle the error
        return redirect()->back()->with('error', 'An error occurred while deleting the post.');
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Post deleted successfully.');
}

}