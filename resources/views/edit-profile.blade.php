@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success text-green-800 font-bold">
        {{ session('success') }}
    </div>
@endif

<!-- show all errors here -->
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger text-red-800 font-bold">
                {{'* ' . $error }}
            </li>
        @endforeach
    </ul>
@endif


<form method="POST" action="{{ route('edit-profile') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-xl font-semibold leading-7 text-gray-900">
                Edit Profile
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
                This information will be displayed publicly so be
                careful what you share.
            </p>

            <div class="mt-10 border-b border-gray-900/10 pb-12">

                <div class="col-span-full mt-10 pb-10">
                    <label for="avatar" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                    <div class="mt-2 flex items-center gap-x-3">
                        <input class="hidden" type="file" name="avatar" id="avatar" onchange="previewAvatar(event)" />

                        <img id="avatarPreview" class="h-32 w-32 rounded-full" src="{{ auth()->user()->avatar_url }}"
                            alt="{{ auth()->user()->username }}" />

                        <label for="avatar">
                            <div
                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                Change
                            </div>
                        </label>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First
                            name</label>
                        <div class="mt-2">
                            <input type="text" name="first_name" id="first_name" autocomplete="given-name"
                                value="{{old('first_name', $user->first_name)}}"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                        </div>
                        @error('first_name')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last
                            name</label>
                        <div class="mt-2">
                            <input type="text" name="last_name" id="last_name"
                                value="{{old('last_name', $user->last_name)}}" autocomplete="family-name"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                        </div>
                        @error('last_name')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                            address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email"
                                value="{{old('email', $user->email)}}"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                        </div>
                        @error('email')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="password"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                        </div>
                        @error('password')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-full">
                    <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
                    <div class="mt-2">
                        <textarea id="bio" name="bio" rows="3"
                            class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{old('bio', $user->bio)}}</textarea>
                    </div>
                    @error('bio')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        Write a few sentences about yourself.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="{{ route('profile', $user->username) }}" type="button"
            class="text-sm font-semibold leading-6 text-gray-900">
            Cancel
        </a>
        <button type="submit"
            class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
            wire:dirty.class="hover:bg-blue-900" wire:dirty.remove.attr="disabled">
            Save
        </button>
    </div>
</form>

@endsection

@section('scripts')
<script>
    function previewAvatar(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('avatarPreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection