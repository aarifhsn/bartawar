<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\User;

class CommentPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $post;
    public $user;
    public $comment;
    public function __construct(Post $post, User $user, string $comment)
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
        return new PrivateChannel('post.' . $this->post->id);
    }

    public function broadcastWith()
    {
        return [
            'post' => $this->post->toArray(),
            'user' => $this->user->toArray(),
            'comment' => $this->comment,
        ];
    }

}
