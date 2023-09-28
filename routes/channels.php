<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('chat', function ($user) {
    return true; // You can add authorization logic here if needed
});

Broadcast::channel('private-chat.{roomId}', function ($user, $roomId) {
    // Implement your authorization logic here
    return $user->canAccessChatRoom($roomId);
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


