<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class HomePage extends Component
{

    use WithPagination;

    public $postCount = 10;

    public function loadMore()
    {
        $this->postCount = $this->postCount + 10;
    }
    public function render()
    {
        $posts = Post::latest()->cursorPaginate($this->postCount);

        return view('livewire.home-page')->with('posts', $posts);
    }
}
