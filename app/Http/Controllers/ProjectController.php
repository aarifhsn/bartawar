<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function home()
    {
        $posts = Post::with('user')->latest('created_at')->get();

        return view('home', compact('posts'));
    }
}
