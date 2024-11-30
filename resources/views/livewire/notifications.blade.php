<div id="toast-notification"
    class="w-full max-w-md p-4 text-gray-900 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-300"
    role="alert">
    <div class="flex items-center justify-between mb-3">
        <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white flex justify-end gap-2">New
            notification</span>
        @if (count($unreadNotifications) > 0)
            <button class="px-2 py-1 border border-gray-200 hover:bg-gray-200 text-black rounded-lg text-xs"
                wire:click="markAllAsRead">Mark All as
                Read</button>
            <a href="{{ route('notifications', auth()->user()->username) }}"
                class="px-2 py-1 border border-gray-200 hover:bg-gray-200 text-black rounded-lg text-xs"> View all</a>
        @else
            <a href="{{ route('notifications', auth()->user()->username) }}"
                class="px-2 py-1 border border-gray-200 hover:bg-gray-200 text-black rounded-lg text-sm"> View old
                notifications</a>
        @endif

    </div>

    @forelse ($unreadNotifications as $notification)
        <div class="flex items-center my-4 {{ $notification->read_at ? 'bg-slate-50' : 'bg-slate-200' }} p-4 rounded-lg">
            <div class="flex-none relative inline-block shrink-0">
                <img class="w-12 h-12 rounded-full border-2 border-gray-800" src="{{ $user->avatar_url }}"
                    alt="{{ $user->username }}" />
                <span
                    class="absolute bottom-0 right-0 inline-flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full">
                    @if(isset($notification->data['commenter_name']))
                        <svg class="w-3 h-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 18" fill="currentColor">
                            <path
                                d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z"
                                fill="currentColor" />
                            <path
                                d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z"
                                fill="currentColor" />
                        </svg>
                    @elseif(isset($notification->data['liker_name']))
                        <svg class="w-3 h-3 text-white" aria-hidden="true" id=" Layer_1" data-name="Layer 1"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 105.01" fill="currentColor">

                            <path
                                d="M4,43.36H32.37a4,4,0,0,1,4,4V101a4,4,0,0,1-4,4H4a4,4,0,0,1-4-4V47.39a4,4,0,0,1,4-4ZM62.16,6.3A7.36,7.36,0,0,1,66.23.65,8.14,8.14,0,0,1,71.79.34a15.36,15.36,0,0,1,5.3,2.71A26.21,26.21,0,0,1,86.81,21.9a57.41,57.41,0,0,1-.12,8.35q-.25,2.94-.76,6.15h20.2a21.58,21.58,0,0,1,9.1,2.33,14.7,14.7,0,0,1,5.6,4.92,12.55,12.55,0,0,1,2,7.51,18.1,18.1,0,0,1-1.82,6.93,21.82,21.82,0,0,1,.54,8.38,9.7,9.7,0,0,1-2.78,5.68,25.22,25.22,0,0,1-1.4,9.43,19.81,19.81,0,0,1-4.5,7,28.37,28.37,0,0,1-.9,5A17.3,17.3,0,0,1,109.5,99h0c-3.43,4.84-6.17,4.73-10.51,4.55-.61,0-1.26,0-2.26,0H57.39a19.08,19.08,0,0,1-8.86-1.78,21.13,21.13,0,0,1-7-6.06L41,94V48.15l2-.53c5.08-1.37,9.07-5.71,12.16-10.9a75.8,75.8,0,0,0,7-16.64V6.82l.06-.52Zm6.32-.78a2.15,2.15,0,0,0-1,1.57V20.46l-.12.77a82.31,82.31,0,0,1-7.61,18.24C56.4,45.09,52,49.91,46.37,52.14V93.07A14.6,14.6,0,0,0,50.93,97a14.14,14.14,0,0,0,6.46,1.21H96.73c.7,0,1.61,0,2.47.08,2.57.1,4.2.17,5.94-2.29h0a12.34,12.34,0,0,0,1.71-3.74,24.86,24.86,0,0,0,.79-5l.83-1.77a14.89,14.89,0,0,0,3.9-5.75,21.18,21.18,0,0,0,1-8.67l-.1-1.6,1.36-.84a4.09,4.09,0,0,0,1.64-3,17.44,17.44,0,0,0-.68-7.12l.21-1.94A13.12,13.12,0,0,0,117.51,51a7.29,7.29,0,0,0-1.17-4.38,9.53,9.53,0,0,0-3.59-3.12A16,16,0,0,0,106,41.77H79.51l.6-3.18a85.93,85.93,0,0,0,1.22-8.79,51,51,0,0,0,.13-7.55,20.76,20.76,0,0,0-7.62-15,10.15,10.15,0,0,0-3.41-1.79,3,3,0,0,0-2,0ZM22.64,85.3a5.13,5.13,0,1,1-5.13,5.13,5.13,5.13,0,0,1,5.13-5.13Z" />
                        </svg>
                    @endif
                    <span class="sr-only">Message icon</span>
                </span>
            </div>
            <div class="flex-auto ms-3 text-sm font-normal">
                <div class="flex justify-between">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                        @if(isset($notification->data['commenter_name']))
                            {{ $notification->data['commenter_name'] }}
                            <div class="text-sm font-normal">commented on your post</div>
                        @elseif(isset($notification->data['liker_name']))
                            {{ $notification->data['liker_name'] }}
                            <div class="text-sm font-normal">Liked on your post</div>
                        @endif
                        <span
                            class="text-xs font-medium text-blue-600 dark:text-blue-500">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>

                </div>
            </div>
            <button class="flex-1" wire:click="markAsRead('{{ $notification->id }}')">
                <span
                    class="text-md text-gray-700  border border-slate-200 hover:bg-slate-300 p-1 px-2 rounded-full">&#10003;</span>
            </button>
        </div>

    @empty
        <p class="text-sm text-gray-500">No new notification.</p>
    @endforelse
    {{ $unreadNotifications->links(data: ['scrollTo' => false]) }}
</div>

@push('scripts')

@endpush