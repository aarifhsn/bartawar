<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Notifications\PostCommented;
use App\Events\CommentPosted;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Auth;

class PostComments extends Component
{
    use WithPagination;
    public Post $post;

    #[Validate('required|min:3|max:255')]
    public string $comment = '';

    public function postComment()
    {
        $this->validate();

        $post = $this->post;
        $post_author = $this->post->user;
        $commenter = Auth::user();
        $comment = $this->comment;

        $this->post->comments()->create([
            'user_id' => Auth::user()->id,
            'comment' => $this->comment,
        ]);
        $this->comment = '';

        // Trigger the PostCommented notification
        $post_author->notify(new PostCommented($post, $commenter, $comment));

        // Trigger the CommentPosted event
        CommentPosted::dispatch($post, $post_author, $comment);
    }

    #[Computed]
    public function comments()
    {
        return $this?->post?->comments()->latest()->paginate(5);
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
