<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostServices
{
    public function createPost(PostRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'image' => $imagePath,
            'created_at' => now(),
        ]);
    }

    public function updatePost(PostRequest $request, string $username, string $id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post) {
            return redirect()->route('profile', ['username' => $username])->with('error', 'Post not found.');
        }
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('profile', ['username' => $username])->with('error', 'You are not authorized to update this post.');
        }
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            // Store the new image and save its path
            $path = $request->file('image')->store('posts', 'public');
            $post->image = $path;
        }

        $post->updated_at = now();

        $post->save();

        return $post;
    }

}
