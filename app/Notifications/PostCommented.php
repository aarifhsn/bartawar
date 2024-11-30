<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class PostCommented extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $post;
    public $commenter;
    public $comment;
    public function __construct($post, $commenter, $comment)
    {
        $this->post = $post;
        $this->commenter = $commenter;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your post received a new comment')
            ->line("{$this->commenter->first_name} {$this->commenter->last_name} commented on your post:")
            ->line($this->comment)
            ->action('View Post', url("/posts/{$this->post->id}"))
            ->line('Thank you for your valuable feedback!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "{$this->commenter->first_name} {$this->commenter->last_name} commented on your post.",
            'post_id' => $this->post->id,
            'commenter_name' => "{$this->commenter->first_name} {$this->commenter->last_name}",
            'comment' => $this->comment,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->commenter->first_name . ' ' . $this->commenter->last_name . ' commented on your post!',
            'post_id' => $this->post->id,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "{$this->commenter->first_name} {$this->commenter->last_name} commented on your post.",
            'commenter_name' => "{$this->commenter->first_name} {$this->commenter->last_name}",
            'comment_id' => $this->comment->id,
            'post_id' => $this->post->id,
        ];
    }
}
