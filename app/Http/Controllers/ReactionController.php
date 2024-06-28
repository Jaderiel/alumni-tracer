<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
use App\Models\Forum; // Import the Forum model
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogHelper; // Assuming you have a helper for activity logging

class ReactionController extends Controller
{
    public function like(Request $request)
    {
        $userId = Auth::id();
        $forumId = $request->input('forum_id');

        // Retrieve the post details
        $post = Forum::findOrFail($forumId);

        // Check if the reaction already exists
        $reaction = Reaction::where('user_id', $userId)->where('forum_id', $forumId)->first();

        if ($reaction) {
            // Toggle the like status
            $reaction->is_liked = !$reaction->is_liked;
            $reaction->save();
        } else {
            // Create new reaction as liked
            $reaction = Reaction::create([
                'user_id' => $userId,
                'forum_id' => $forumId,
                'is_liked' => true,
                'comment' => '', // Assuming comment is not required for this action
            ]);
        }

        // Log the activity
        $activity = $reaction->is_liked ? 'Liked a post' : 'Unliked a post';
        $description = 'Caption: ' . $post->caption;
        if ($post->media_url) {
            $description .= ', Media URL: ' . $post->media_url;
        }
        ActivityLogHelper::log($userId, $activity, $description);

        return response()->json(['success' => true, 'is_liked' => $reaction->is_liked]);
    }
}

