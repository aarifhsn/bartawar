<div>
    @if(session('success'))
        <div
            class="alert alert-success p-2.5 text-sm font-bold text-slate-500 border-2  border-slate-200  rounded-xl inline-block">
            {{ session('success') }}
        </div>
    @endif

    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">

        <!-- Single post -->
        <article id="newsfeed" class="space-y-6">
            <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">

                <!-- Barta Card Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- User Info -->
                            <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                <a href="{{route('profile', $user->username)}}"
                                    class="hover:underline font-semibold line-clamp-1">
                                    {{ $user->full_name }}
                                </a>

                                <a href="{{route('profile', $user->username)}}"
                                    class="hover:underline text-sm text-gray-500 line-clamp-1">
                                    {{'@' . $user->username }}
                                </a>
                            </div>
                            <!-- /User Info -->
                        </div>

                        @if(Auth::check() && Auth::user()->id == $post->user->id)

                            @include('components.card-action')
                        @endif

                    </div>
                </header>

                <!-- Content -->
                <div class="py-4 text-gray-700 font-normal">

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                            class="min-h-auto w-full rounded-lg object-cover mb-3" alt="{{ $user->username }}" />
                    @endif

                    <p>
                        {{ $post->content }}
                    </p>
                </div>

                <!-- Date Created & View Stat -->
                <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                    <span class="">{{ $post->created_at->diffForHumans() }}</span>
                </div>

                @include ('components.card-comment', ['post' => $post])

                <livewire:post-comments :post="$post" />
            </article>

            </section>
            <!-- /Single post -->
    </main>
</div>