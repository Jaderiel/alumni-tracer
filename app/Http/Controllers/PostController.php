<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;

class PostController extends Controller
{
    public function store(Request $request)
{
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

}
