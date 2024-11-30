<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Reactive;
use App\Notifications\PostLiked;
use App\Events\PostLikedEvent;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{

    public Post $post;
    public int $likeCount;
    public bool $hasLiked;

    public function mount()
    {
        // Initialize properties
        $this->likeCount = $this->post->likes()->count();
        $this->hasLiked = Auth::check() && auth()->user()->hasLiked($this->post);
    }

    public function toogleLike()
    {
        if (Auth::guest()) {
            return redirect(route('login'), true);
        }

        $user = Auth::user();
        $post = $this->post;
        $post_author = $this->post->user;

        if ($this->hasLiked) {
            $user->likes()->detach($this->post);
            $this->likeCount--;
        } else {
            $user->likes()->attach($this->post);
            $this->likeCount++;

            // Notify the post owner
            $post_author->notify(new PostLiked($user, $post));

            // Trigger the PostLiked event
            PostLikedEvent::dispatch($post, $post_author);
        }
        $this->hasLiked = !$this->hasLiked;
    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
