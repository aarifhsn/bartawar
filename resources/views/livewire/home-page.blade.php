<div>

    @if(session('success'))
        <div
            class="alert alert-success p-2.5 text-sm font-bold text-slate-500 border-2  border-slate-200  rounded-xl inline-block">
            {{ session('success') }}
        </div>
    @elseif ($errors->any())
        <div
            class="alert alert-success p-2.5 text-sm font-bold text-red-700 border-2  border-slate-200  rounded-xl inline-block">
            {{ $errors->first() }}
        </div>
    @endif

    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        @if($posts->isEmpty())
            <div>
                @guest
                    <div class="text-center p-12 border border-gray-800 rounded-xl">
                        <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>
                        <p class="mt-8 text-slate-600"><a href="{{ route('login') }}" class="text-blue-600">Log in</a> to create
                            your
                            first post!</p>
                    </div>
                @endguest
            </div>
        @endif

        @if (Auth::check())
            <!-- Barta Create Post Card -->
            @include('components.create-post-card')
            <!-- /Barta Create Post Card -->
        @endif

        @include('components.posts')

    </main>

</div>