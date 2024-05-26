<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function like(Request $request)
    {
        $userId = Auth::id();
        $forumId = $request->input('forum_id');

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

        return response()->json(['success' => true, 'is_liked' => $reaction->is_liked,]);
    }
}
