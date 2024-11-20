<!-- Barta Create Post Card -->
<form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}"
    class="bg-white border-2 border-slate-200 focus-within:ring-1  rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3"
    x-data="{ imagePreview: '', showRemoveButton: false }">
    <!-- Create Post Card Top -->
    @csrf
    <div>
        <div class="flex items-start /space-x-3/">
            <!-- User Avatar -->

            <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->avatar_url }}"
                    alt="{{ auth()->user()->username }}" />
            </div>
            <!-- /User Avatar -->
            <!-- Content -->
            <div class="text-gray-700 font-normal w-full">
                <textarea
                    class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                    name="content" rows="2" placeholder="What's going on, {{Auth::user()->first_name}}"></textarea>
            </div>
        </div>

    </div>

    <!-- Create Post Card Bottom -->
    <div>
        <!-- Card Bottom Action Buttons -->
        <div class="form-group mb-4 relative">
            <!-- Image preview box -->
            <img x-show="imagePreview" x-bind:src="imagePreview" alt="Image Preview"
                style="display: none; max-width: 100%; height: auto;">
            <button id="removeImage" type="button" @click="imagePreview = ''; $refs.imageInput.value = '';
                showRemoveButton=false" class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2.5 py-1"
                x-show="showRemoveButton">
                &times;
            </button>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex gap-4 text-gray-600">
                <!-- Upload Picture Button -->
                <div>
                    <input type="file" name="image" id="image" class="hidden" x-ref="imageInput" @change="if ($event.target.files.length > 0) { 
                            const reader = new FileReader(); 
                            reader.onload = () => { 
                                imagePreview = reader.result; 
                                showRemoveButton = true; 
                            }; 
                            reader.readAsDataURL($event.target.files[0]); 
                        }" />
                    <label for="image"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                        <span class="sr-only">Picture</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </label>
                </div>
            </div>
            <div>
                <!-- Post Button -->
                <button type="submit"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                    Post
                </button>
                <!-- /Post Button -->
            </div>
        </div>
        <!-- /Card Bottom Action Buttons -->
    </div>
    <!-- /Create Post Card Bottom -->
</form>
<!-- /Barta Create Post Card -->