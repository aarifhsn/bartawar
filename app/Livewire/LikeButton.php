<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Reactive;

class LikeButton extends Component
{
    #[Reactive]
    public Post $post;

    public function toogleLike()
    {
        if (auth()->guest()) {
            return redirect(route('login'), true);
        }

        $user = auth()->user();

        if ($user->hasLiked($this->post)) {
            $user->likes()->detach($this->post);
            return;
        } else {
            $user->likes()->attach($this->post);
        }

    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
