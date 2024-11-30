<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CommentPosted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $post;
    public $user;
    public $comment;
    public function __construct($post, $user, $comment)
    {
        $this->post = $post;
        $this->user = $user;
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel
     * The client who is listening this channel will get the notification
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('users.' . $this->user->id);
    }

    public function broadcastWith()
    {
        Log::info('Broadcasting CommentPosted event', [
            'post' => $this->post->id,
            'user' => $this->user->id,
            'comment' => $this->comment,
        ]);
        return [
            'post' => $this->post->toArray(),
            'user' => $this->user->toArray(),
            'comment' => $this->comment,
        ];
    }
}
