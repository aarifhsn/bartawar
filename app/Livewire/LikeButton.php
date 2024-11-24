<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Reactive;
use App\Notifications\PostLiked;

class LikeButton extends Component
{

    public Post $post;

    public int $likeCount;
    public bool $hasLiked;

    public function mount()
    {
        // Initialize properties
        $this->likeCount = $this->post->likes()->count();
        $this->hasLiked = auth()->check() && auth()->user()->hasLiked($this->post);
    }

    public function toogleLike()
    {
        if (auth()->guest()) {
            return redirect(route('login'), true);
        }

        $user = auth()->user();
        $post = $this->post;

        if ($this->hasLiked) {
            $user->likes()->detach($this->post);
            $this->likeCount--;
        } else {
            $user->likes()->attach($this->post);
            $this->likeCount++;

            // Notify the post owner
            $this->post->user->notify(new PostLiked($user, $post));

            // dd($this->post->user->username);
        }

        $this->hasLiked = !$this->hasLiked;

    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
