<!-- Mobile menu, show/hide based on menu state. -->
<div x-show="mobileMenuOpen" class="sm:hidden" id="mobile-menu">
    <!-- check if user logged in -->
    @if (auth()->check())
        <div class="border-t border-gray-200 pt-4 pb-3">
            <div class="flex items-center px-4">
                <div>
                    <div class="text-base font-medium text-gray-800">
                        {{ Auth::user()->full_name }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{route('profile', auth()->user()->username)}}"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Your
                    Profile</a>
                <a href="{{route('edit-profile')}}"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Edit
                    Profile</a>
                <a href="{{route('logout')}}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Sign
                    out</a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    @else
        <div class="border-t border-gray-200 pt-4 pb-3">
            <a href="{{route('login')}}"
                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Login</a>
        </div>
    @endif
</div>