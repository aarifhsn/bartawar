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
            $this->deleteOldReadNotifications();
        }
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->deleteOldReadNotifications();
    }

    private function deleteOldReadNotifications()
    {
        $readNotifications = auth()->user()->readNotifications()->orderBy('created_at', 'desc')->skip(20)->take(PHP_INT_MAX)->get();
        foreach ($readNotifications as $notification) {
            $notification->delete(); // Delete notifications beyond the latest 20
        }
    }

    public function autoMarkAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->deleteOldReadNotifications();
    }

    public function render()
    {
        $userServices = new UserServices();
        $user = $userServices->getAuthUserProfile();

        if (!auth()->check()) {
            return view('livewire.notifications', [
                'notifications' => collect(),
            ]);
        }

        // Merge unread and read notifications, then sort by created_at descending
        $notifications = auth()->user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20); // Paginate combined notifications

        return view('livewire.notifications', [
            'notifications' => $notifications,
        ]);
    }
}
