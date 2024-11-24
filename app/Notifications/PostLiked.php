<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLiked extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $post;
    public $liker;
    public function __construct($liker, $post)
    {
        $this->post = $post;
        $this->liker = $liker;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'broadcast', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "{$this->liker->first_name} {$this->liker->last_name} liked your post.",
            'post_id' => $this->post->id,
            'liker_name' => "{$this->liker->first_name} {$this->liker->last_name}",
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => $this->toDatabase($notifiable),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "{$this->liker->first_name} {$this->liker->last_name} liked your post.",
            'liker_name' => "{$this->liker->first_name} {$this->liker->last_name}",
            'post_id' => $this->post->id,
        ];
    }
}
