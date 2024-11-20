<!-- Card Action Dropdown -->
<div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
    <div class="relative inline-block text-left">
        <div>
            <button @click="open = !open" type="button"
                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600" id="menu-0-button">
                <span class="sr-only">Open options</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path
                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                    </path>
                </svg>
            </button>
        </div>
        <!-- Dropdown menu -->

        <div x-show="open" @click.away="open = false"
            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <a href="{{route('post.edit', ['username' => $post->user->username, 'id' => $post->id])}}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
                id="user-menu-item-0">Edit</a>

            <form action="{{route('post.destroy', ['id' => $post->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    role="menuitem" tabindex="-1" id="user-menu-item-1"
                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
            </form>

        </div>

    </div>
</div>
<!-- /Card Action Dropdown -->