<div class="search_form flex items-center relative">
    <form wire:model.live.debounce="searchText" class="flex items-center">
        <input type="search" placeholder="Search.." name="search"
            class="border-2 border-gray-300 bg-white h-10 px-5 rounded-full text-sm focus:outline-none" />
    </form>

    @if(!empty($results))
        <livewire:search-results :username="$username" :id="$id" :results="$results" />
    @endif
</div>