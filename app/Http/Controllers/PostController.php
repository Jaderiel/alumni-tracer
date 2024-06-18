<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Job;
use App\Models\Reaction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    public function store(Request $request) {
    // Validate the incoming request
        $request->validate([
            'caption' => 'required|string',
            'media_url' => 'image|mimes:jpeg,png,jpg,gif|max:10048', // Adjust the validation rules as needed
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
        $jobCount = Job::where('is_approved', true)->count();
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
    $post = Forum::findOrFail($id);
    
    // Update the caption with the new value from the request
    $post->caption = $request->input('edited_caption');
    
    // Check if a new media file has been uploaded
    if ($request->hasFile('edited_media')) {
        // Store the new media file and update the media URL
        $mediaPath = $request->file('edited_media')->store('public/media');
        $post->media_url = Storage::url($mediaPath);
    }
    
    // Save the updated post
    $post->save();
    
    // Optionally, return a response indicating success
    return response()->json(['message' => 'Post updated successfully']);
}

public function updatePost(Request $request, $id) {
    $request->validate([
        'caption' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {
        $post = Forum::findOrFail($id);
        $post->caption = $request->caption;

        if ($request->hasFile('image')) {
            // Get the file extension from the original file
            $extension = $request->file('image')->getClientOriginalExtension();

            // Generate a new file name with the appropriate extension
            $newFileName = 'image_' . time() . '.' . $extension;

            // Ensure the destination directory exists
            $destinationPath = 'uploads';
            if (!Storage::exists($destinationPath)) {
                Storage::makeDirectory($destinationPath);
            }

            // Move the uploaded file to the desired location with the new file name and extension
            $request->file('image')->move(public_path($destinationPath), $newFileName);

            // Update the post's media_url with the new file path including the extension
            $post->media_url = $destinationPath . '/' . $newFileName;
        }

        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating the post: ' . $e->getMessage());
    }
}




public function delete($id) {
    // Find the post by ID
    $post = Forum::findOrFail($id);
    $post->delete();

    return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
}

    public function addPost() {
        return view('auth.add-post');
    }

    public function showUpdatePost($id) {
        $post = Forum::findOrFail($id);
    
        // Check if the authenticated user's ID matches the post's user ID
        if (auth()->user()->id != $post->user_id && !in_array(auth()->user()->user_type, ['Super Admin', 'Admin'])) {
            return redirect()->route('dashboard');
        }
    
        return view('popups.update-post', compact('post'));
    }    
}