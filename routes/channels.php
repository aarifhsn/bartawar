<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('users.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});

