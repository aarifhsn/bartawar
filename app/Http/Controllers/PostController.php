<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\PostServices;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostServices $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->postService->createPost($request);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username, string $id)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = Post::where('id', $id)->first();

        // Check if post exists
        if (!$post) {
            return redirect()->route('profile', ['username' => $username])->with('error', 'Post not found.');
        }

        return view('edit-post', compact('user', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $username, string $id)
    {
        // Use the post service to update the post
        $post = $this->postService->updatePost($request, $username, $id);

        if (!$post) {
            return redirect()->route('profile', ['username' => $username])->with('error', 'Post not found or you are not authorized to update this post.');
        }

        return redirect()->route('post.show', ['username' => $username, 'id' => $id])->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('home')->with('error', 'You are not authorized to delete this post!');
        }
        $post->delete();

        return redirect(route('profile', ['username' => Auth::user()->username]))->with('success', 'Post deleted successfully!');

    }
}
