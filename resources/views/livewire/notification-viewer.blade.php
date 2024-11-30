<div id="notification-viewer" class="absolute right-2" x-data="{ dispatched: false }" x-init="@if(Auth::check()) 
    Echo.private('users.{{ Auth::id() }}')
        .listen('CommentPosted', (e) => {
            dispatched = true;
        })
        .listen('PostLikedEvent', (e) => {
            dispatched = true;
        })
 @endif">
    @if(Auth::check())
        @foreach(Auth::user()->notifications as $notification)
            <section>
                <template x-if="dispatched">
                    <div id="toast-default-{{ $notification->id }}"
                        class="flex right-2 mt-2 items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                        role="alert">
                        <div class="ms-3 text-sm font-normal">You have a new notification. <a class="text-blue-700"
                                href="{{ route('notifications', auth()->user()?->username) }}">View</a></div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                            @click="document.getElementById('toast-default-{{ $notification->id }}').remove()"
                            aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                </template>
            </section>
        @endforeach
    @endif
</div>