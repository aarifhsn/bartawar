<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostInteraction;

class InteractionController extends Controller
{

    public function likePost(Post $post)
    {
        $user = auth()->user();

        // Add like logic here (e.g., create a like record)

        // Notify the post owner
        $post->user->notify(new PostInteraction($post, 'liked', $user));

        return back()->with('success', 'You liked the post.');
    }

    public function commentOnPost(Post $post, Request $request)
    {
        $user = auth()->user();

        // Add comment logic here (e.g., save the comment)


        // Notify the post owner
        $post->user->notify(new PostInteraction($post, 'commented', $user));

        return back()->with('success', 'Your comment was added.');
    }

}
