<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\UserServices;

class Notifications extends Component
{
    use WithPagination;

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()
            ->notifications()
            ->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        $userServices = new UserServices();
        $user = $userServices->getAuthUserProfile();

        if (!auth()->check()) {
            return view('livewire.notifications', [
                'unreadNotifications' => collect(), // Return an empty collection
                'readNotifications' => collect(),
            ]);
        }

        return view('livewire.notifications', [
            'user' => $user,
            'unreadNotifications' => auth()->user()->unreadNotifications()->latest()->paginate(10),
            'readNotifications' => auth()->user()->readNotifications()->latest()->paginate(10),
        ]);
    }
}
