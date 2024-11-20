@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success text-green-800 font-bold">
        {{ session('success') }}
    </div>
@endif

@if (Auth::check() && Auth::user()->username == $user->username)
    <form method="POST" action="{{route('post.show', ['username' => $user->username, 'id' => $post->id])}}"
        x-data="{imagePreview: '' , showRemoveButton: false }" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Update Post
                            Content</label>
                        <div class="mt-2">
                            <textarea id="content" name="content" rows="3"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{old('content', $post->content)}}</textarea>
                        </div>
                        @error('content')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Display the current image (if exists) --}}
                    @if ($post->image)
                        <div class="col-span-full">
                            <label class="block text-sm font-medium text-gray-900">Current Image</label>
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                    class="h-48 w-48 object-cover">
                            </div>
                        </div>
                    @endif

                    {{-- Image Upload Field --}}
                    <div class="col-span-full">
                        <div class="form-group mb-4 relative">
                            <!-- Image preview box -->
                            <img x-show="imagePreview" x-bind:src="imagePreview" alt="Image Preview"
                                style="display: none; max-width: 100%; height: auto;">
                            <button id="removeImage" type="button"
                                @click="imagePreview = ''; $refs.imageInput.value = ''; showRemoveButton=false"
                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2.5 py-1"
                                x-show="showRemoveButton">
                                &times;
                            </button>

                        </div>
                        <label for="image" class="block text-sm font-medium text-gray-900">Upload New Image</label>
                        <div class="mt-2">
                            <input type="file" name="image" id="image"
                                class=" block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none"
                                x-ref="imageInput" @change="if ($event.target.files.length > 0) { 
                                                                const reader = new FileReader(); 
                                                                reader.onload = () => { 
                                                                    imagePreview = reader.result; 
                                                                    showRemoveButton = true; 
                                                                }; 
                                                                reader.readAsDataURL($event.target.files[0]); 
                                                            }" />
                        </div>
                        @error('image')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror


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
                class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                Save
            </button>
        </div>
    </form>
@else
    <div class="text-center p-12 border border-gray-800 rounded-xl">
        <h1 class="text-3xl justify-center items-center">You do not have permission to edit this post</h1>
    </div>
@endif

@endsection