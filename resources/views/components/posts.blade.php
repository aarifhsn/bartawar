<!-- Newsfeed -->
<section id="newsfeed" class="space-y-6">
    <!-- Barta Card -->
    @foreach ($posts as $post)
        <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Barta Card Top -->
            <header>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- User Info -->
                        <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                            <a wire:navigate href="{{route('profile', $post->user->username)}}"
                                class="hover:underline font-semibold line-clamp-1">
                                {{ $post->user->first_name }} {{ $post->user->last_name }}
                            </a>

                            <a wire:navigate href="{{route('profile', $post->user->username)}}"
                                class="hover:underline text-sm text-gray-500 line-clamp-1">
                                {{'@' . $post->user->username }}
                            </a>
                        </div>
                        <!-- /User Info -->
                    </div>
                    @if (Auth::check() && (Auth::user()->id == $post->user->id || Auth::user()->is_admin))
                        <!-- Card Action Dropdown -->
                        @include('components.card-action', ['post' => $post])
                        <!-- /Card Action Dropdown -->
                    @endif
                </div>
            </header>

            <!-- Content -->
            <div class="py-4 text-gray-700 font-normal">
                @if($post->image)
                    <a wire:navigate href="{{route('post.show', ['username' => $post->user->username, 'id' => $post->id])}}">
                        <img src="{{ asset('storage/' . $post->image) }}"
                            class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72 mb-3" alt="" />
                    </a>
                @endif
                <p>
                    <a wire:navigate href="{{route('post.show', ['username' => $post->user->username, 'id' => $post->id])}}"
                        class="hover:underline">
                        {{ $post->content }}
                    </a>

                </p>
            </div>

            <!-- Date Created & View Stat -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                <span class="">{{ $post->created_at->diffForHumans() }}</span>
            </div>

            @include ('components.card-comment', ['post' => $post])
        </article>
    @endforeach
    <!-- /Barta Card -->

    @if ($posts->isEmpty())
        <div>
                <div class="text-center p-12 border border-gray-800 rounded-xl">
                    <h3 class="text-3xl justify-center items-center">No posts found</h3>
                </div>
        </div>
        
    @endif

    <!-- check if there are more posts -->
    @if ($posts->hasMorePages())
        <div class="text-right">
            <button wire:click="loadMore"
                class=" text-white  bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none ">Show
                More</button>
        </div>
    @endif
</section>
<!-- /Newsfeed -->