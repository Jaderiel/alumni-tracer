<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupForum;
use App\Helpers\ActivityLogHelper;
use App\Models\Reaction;

class GroupForumController extends Controller
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
        $todaysPostCount = GroupForum::where('user_id', $user->id)
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
        $post = new GroupForum();
        $post->user_id = $user->id;
        $post->course = $user->course;
        $post->caption = $request->caption;
        $post->media_url = $mediaUrl;
        $post->save();

        // Log the activity with both caption and media URL
        $description = '' . $post->caption;
        if ($mediaUrl) {
            $description .= ', Media URL: ' . asset($mediaUrl);
        }
        ActivityLogHelper::log(auth()->id(), 'Created a post', $description);

        // Redirect back or to a specific route
        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function addPost() {
        return view('auth.add-post-group');
    }

    public function editPost($id) {
        $post = GroupForum::findOrFail($id);
        return view('popups.update-group-post', compact('post'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'caption' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        try {
            // Retrieve the post by ID
            $post = GroupForum::findOrFail($id);
    
            // Retrieve the original caption and media URL for comparison
            $originalCaption = $post->caption;
            $originalMediaUrl = $post->media_url;
    
            // Update the caption with the new value from the request
            $post->caption = $request->caption;
    
            // Check if a new image file has been uploaded
            if ($request->hasFile('image')) {
                // Process image upload
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $newFileName = 'image_' . time() . '.' . $extension;
                $destinationPath = 'images';
    
                // Move uploaded file to the desired location
                $image->move(public_path($destinationPath), $newFileName);
    
                // Update the post's media_url with the new file path
                $post->media_url = $destinationPath . '/' . $newFileName;
    
                // Log activity including media URL
                $activityDescription = 'from "' . $originalCaption . '" to "' . $post->caption . '", Media URL: ' . $post->media_url;
            } else {
                // Log activity without media URL
                $activityDescription = 'from "' . $originalCaption . '" to "' . $post->caption . '"';
            }
    
            // Save the updated post
            $post->save();
    
            // Log the activity
            ActivityLogHelper::log(auth()->id(), 'Updated a post', $activityDescription);
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions and redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while updating the post: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            // Find the post by ID
            $post = GroupForum::findOrFail($id);
            
            // Retrieve the caption and media URL
            $caption = $post->caption;
            $mediaUrl = $post->media_url;
            
            // Delete the post
            $post->delete();
            
            // Prepare the description for the activity log
            $description = $caption;
            if ($mediaUrl) {
                $description .= ', Media URL: ' . asset($mediaUrl);
            }
            
            // Log the activity
            ActivityLogHelper::log(auth()->id(), 'Deleted a post', $description);
            
            return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'An error occurred while deleting the post: ' . $e->getMessage());
        }
    }
}
