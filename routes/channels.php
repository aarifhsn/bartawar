<?php

use Illuminate\Support\Facades\Broadcast;

// channel is actually the creator of the post
Broadcast::channel('post.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
