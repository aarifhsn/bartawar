<div class="{{ count($results) > 0 ? 'block' : 'hidden' }}">
    <div class="absolute top-16 left-0 w-full bg-white flex flex-col justify-center items-start">

        @forelse ($results as $result)
            <div class="p-4 border-b border-slate-300">
                <a href="" class="hover:text-slate-600">
                    {{ Str::limit($result->content, 50) }}
                </a>
            </div>
        @empty
            <div class="p-4 border-b border-slate-300">
                <p class="text-sm text-gray-500">No posts found</p>
            </div>
        @endforelse
    </div>
</div>