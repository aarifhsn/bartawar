<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class NotificationViewer extends Component
{
    public function render()
    {
        //get all posts
        $posts = Post::all();
        return view('livewire.notification-viewer', compact('posts'));
    }
}
