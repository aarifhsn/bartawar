<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;

class ShowPost extends Component
{
    public $username;
    public $id;

    public $user;
    public $post;

    public function mount($username, $id)
    {
        $this->username = $username;
        $this->id = $id;

        $user = User::where('username', $username)->first();
        $post = Post::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        $this->user = $user;
        $this->post = $post;

    }
    public function render()
    {
        return view('livewire.show-post', [
            'posts' => $this->post,
            'users' => $this->user
        ]);
    }
}
