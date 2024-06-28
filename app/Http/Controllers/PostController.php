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
use App\Helpers\ActivityLogHelper;


class PostController extends Controller
{
    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'caption' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:10048', // Adjust the validation rules as needed
    ]);

    // Check if the user has already created 3 posts today
    $user = auth()->user();
    $todaysPostCount = Forum::where('user_id', $user->id)
                            ->whereDate('created_at', today())
                            ->count();

    if ($todaysPostCount >= 3) {
        return redirect()->back()->with('error', 'You have reached the daily limit of 3 posts.');
    }

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
    $post->user_id = $user->id;
    $post->caption = $request->caption;
    $post->media_url = $mediaUrl;
    $post->save();

    // Log the activity with both caption and media URL
    $description = '' . $post->caption;
    if ($mediaUrl) {
        $description .= '' . $mediaUrl;
    }
    ActivityLogHelper::log(auth()->id(), 'Created a post', $description);

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
    
    // Retrieve the original caption for comparison
    $originalCaption = $post->caption;

    // Update the caption with the new value from the request
    $post->caption = $request->input('edited_caption');
    
    // Check if a new media file has been uploaded
    if ($request->hasFile('edited_media')) {
        // Store the new media file and update the media URL
        $mediaPath = $request->file('edited_media')->store('public/media');
        $post->media_url = Storage::url($mediaPath);

        // Log activity including media URL
        ActivityLogHelper::log(auth()->id(), 'Updated a post', 'Updated caption from "' . $originalCaption . '" to "' . $post->caption . '". Media URL: ' . $post->media_url);
    } else {
        // Log activity without media URL
        ActivityLogHelper::log(auth()->id(), 'Updated a post', 'Updated caption from "' . $originalCaption . '" to "' . $post->caption . '"');
    }
    
    // Save the updated post
    $post->save();
    
    // Optionally, return a response indicating success
    return response()->json(['message' => 'Post updated successfully']);
}

public function updatePost(Request $request, $id)
{
    $request->validate([
        'caption' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {
        // Retrieve the post by ID
        $post = Forum::findOrFail($id);

        // Retrieve the original caption for comparison
        $originalCaption = $post->caption;

        // Update the caption with the new value from the request
        $post->caption = $request->caption;

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            // Process image upload
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $newFileName = 'image_' . time() . '.' . $extension;
            $destinationPath = 'uploads';

            // Move uploaded file to the desired location
            $image->move(public_path($destinationPath), $newFileName);

            // Update the post's media_url with the new file path
            $post->media_url = $destinationPath . '/' . $newFileName;

            // Log activity including media URL
            ActivityLogHelper::log(auth()->id(), 'Updated a post', 'from "' . $originalCaption . '" to "' . $post->caption . '". Media URL: ' . $post->media_url);
        } else {
            // Log activity without media URL
            ActivityLogHelper::log(auth()->id(), 'Updated a post', 'from "' . $originalCaption . '" to "' . $post->caption . '"');
        }

        // Save the updated post
        $post->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Post updated successfully!');
    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'An error occurred while updating the post: ' . $e->getMessage());
    }
}




public function delete($id) {
    // Find the post by ID
    $post = Forum::findOrFail($id);
    $post->delete();

    ActivityLogHelper::log(auth()->id(), 'Deleted a post', '' . $post->caption);

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