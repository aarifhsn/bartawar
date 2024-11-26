<div>
    <hr class="my-2" />

    @auth
        <!-- Barta Create Comment Form -->
        <form wire:submit.prevent="postComment">
            <!-- Create Comment Card Top -->
            <div>
                <div class="flex items-start space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->avatar_url }}"
                            alt="{{ auth()->user()->full_name }}" />
                    </div>
                    <!-- /User Avatar -->

                    <!-- Auto Resizing Comment Box -->
                    <div class="text-gray-700 font-normal w-full">
                        <textarea wire:model="comment" id="comment"
                            x-data="{resize () {$el.style.height = '0px';$el.style.height = $el.scrollHeight + 'px'}}"
                            x-init="resize()" @input="resize()" name="comment" placeholder="Write a comment..."
                            class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900"></textarea>
                    </div>
                </div>
            </div>

            <!-- Create Comment Card Bottom -->
            <div>
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-end mb-2">
                    <button type="submit"
                        class="mt-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                        Comment
                    </button>
                </div>

                <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Comment Card Bottom -->

            @error('comment')
                <div class="py-4 text-red-700 font-normal">
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <div wire:loading class="py-4 text-slate-500 text-sm font-normal">
                Submitting your comment...
            </div>
        </form>
        <!-- /Barta Create Comment Form -->
    @else
        <div class="py-4 text-red-700 font-normal">
            <p>
                You must be logged in to comment. <a wire:navigate class="font-bold italic underline"
                    href="{{ route('login', ['redirect' => url()->current() . '#comments']) }}">Login</a>
            </p>
        </div>
    @endauth


    <hr />
    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold mt-4">Comments ({{ $post->comments()->count() }})</h1>

        <!-- Barta User Comments Container -->
        <article
            class="bg-white border-2 border-slate-200 rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y">
            <!-- Comments -->

            <!-- Single Comment -->
            <!-- show ascending order comment  -->

            @forelse ($this->comments as $comment)
                <div class="py-4">
                    <!-- Barta User Comments Top -->
                    <header>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">

                                <!-- User Avatar -->
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $comment->user->avatar_url }}"
                                        alt="{{ $comment->user->full_name }}" />
                                </div>
                                <!-- /User Avatar -->

                                <!-- User Info -->
                                <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                    <a href="{{route('profile', $comment->user->username)}}"
                                        class="hover:underline font-semibold line-clamp-1">
                                        {{ $comment->user->full_name }}
                                    </a>

                                    <a href="{{route('profile', $comment->user->username)}}"
                                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                                        {{'@' . $comment->user->username }}
                                    </a>
                                </div>
                                <!-- /User Info -->
                            </div>
                        </div>
                    </header>

                    <!-- Content -->
                    <div class="py-4 text-gray-700 font-normal">
                        <p>
                            {{ $comment->comment }}
                        </p>
                    </div>

                    <!-- Date Created -->
                    <div class="flex items-center gap-2 text-gray-500 text-xs">
                        <span class="">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <!-- /Single Comment -->
            @empty
                <div class="py-4 text-gray-700 font-normal">
                    <p>No comments yet.</p>
                </div>
            @endforelse

            <!-- /Comments -->
        </article>
        <!-- /Barta User Comments -->

        <div class="my-2">
            {{ $this->comments->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>