@extends('layouts.app')

@section('content')

@if(session('success'))
    <div
        class="alert alert-success p-2.5 text-sm font-bold text-slate-500 border-2  border-slate-200  rounded-xl inline-block">
        {{ session('success') }}
    </div>
@endif

<section
    class="bg-white border-2 p-8 border-gray-200 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">

    <!-- Profile Info -->
    <div class="flex gap-4 justify-center flex-col text-center items-center">

        <!-- Avatar -->
        <div class="relative">
            <img class="w-32 h-32 rounded-full border-2 border-gray-800" src="{{ $user->avatar_url }}"
                alt="{{ $user->username }}" />
        </div>

        <!-- User Meta -->
        <div>
            <h1 class="font-bold md:text-2xl pt-2 pb-8">{{ $user->full_name }}</h1>
            <p class="text-gray-700">
                {{ $user->bio ?? (Auth::check() && Auth::id() == $user->id ? 'Please update your profile to add a bio.' : '') }}
            </p>

        </div>
        <!-- / User Meta -->

        <!-- Profile Stats -->
        <div class="flex flex-row gap-16 justify-center text-center items-center">
            <!-- Total Posts Count -->
            <div class="flex flex-col justify-center items-center">
                <h4 class="sm:text-xl font-bold">{{$user->posts->count()}}</h4>
                <p class="text-gray-600">Posts</p>
            </div>

            <!-- Total Comments Count -->
            <div class="flex flex-col justify-center items-center">
                <h4 class="sm:text-xl font-bold">{{ $user->comments->count() }}</h4>
                <p class="text-gray-600">Comments</p>
            </div>
        </div>
        <!-- /Profile Stats -->
    </div>
    <!-- /Profile Info -->

    <!-- Edit Profile Button (Only visible to the profile owner) -->
    @if (Auth::check() && Auth::id() == $user->id)
        <a href="{{route('edit-profile')}}" type="button"
            class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
            </svg>

            Edit Profile
        </a>
    @endif
    <!-- /Edit Profile Button -->
</section>

<!-- Auth user posts  -->

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
                            <a href="{{route('profile', $post->user->username)}}"
                                class="hover:underline font-semibold line-clamp-1">
                                {{ $post->user->first_name }} {{ $post->user->last_name }}
                            </a>

                            <a href="{{route('profile', $post->user->username)}}"
                                class="hover:underline text-sm text-gray-500 line-clamp-1">
                                {{'@' . $post->user->username }}
                            </a>
                        </div>
                        <!-- /User Info -->
                    </div>
                    @if (Auth::check() && Auth::user()->id == $post->user->id)
                        <!-- Card Action Dropdown -->
                        @include('components.card-action', ['post' => $post])
                        <!-- /Card Action Dropdown -->
                    @endif
                </div>
            </header>

            <!-- Content -->
            <div class="py-4 text-gray-700 font-normal">
                @if($post->image)
                    <a href="{{route('post.show', ['username' => $post->user->username, 'id' => $post->id])}}">
                        <img src="{{ asset('storage/' . $post->image) }}"
                            class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72 mb-3" alt="" />
                    </a>
                @endif
                <p>
                    <a href="{{route('post.show', ['username' => $post->user->username, 'id' => $post->id])}}"
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
</section>
<!-- /Newsfeed -->

<!-- End Auth user posts  -->

@endsection