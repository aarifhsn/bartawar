<!-- Barta Card Bottom -->
<footer class="border-t border-gray-200 pt-2">
    <!-- Card Bottom Action Buttons -->
    <div class="flex items-center justify-between">
        <div class="flex gap-8 text-gray-600">
            <!-- Comment Button -->
            <a href="{{ route('post.show', ['post' => $post, 'id' => $post->id, 'username' => $post->user->username]) }}"
                type="button"
                class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                <span class="sr-only">Comment</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                </svg>

                <p>{{ $post->comments()->count() }}</p>
            </a>
            <!-- /Comment Button -->

            <livewire:like-button :key="$post->id" :post="$post" />

        </div>
    </div>
    <!-- /Card Bottom Action Buttons -->
</footer>
<!-- /Barta Card Bottom -->