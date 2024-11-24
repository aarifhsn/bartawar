<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Notifications\PostCommented;

use Illuminate\Support\Facades\Log;

class PostComments extends Component
{
    use WithPagination;
    public Post $post;

    #[Validate('required|min:3|max:255')]
    public string $comment;

    public function postComment()
    {
        $post = $this->post;
        $comment = $this->comment;
        $commenter = auth()->user();


        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $this->comment,
        ]);
        $this->post->user->notify(new PostCommented($post, $commenter, $comment));

        $this->comment = '';

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
