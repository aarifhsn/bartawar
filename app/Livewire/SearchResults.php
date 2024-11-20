<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class SearchResults extends Component
{

    #[Reactive]
    public $results = [];

    public function updateResults($results)
    {
        $this->results = $results;
    }

    public function render()
    {
        return view('livewire.search-results');
    }
}
