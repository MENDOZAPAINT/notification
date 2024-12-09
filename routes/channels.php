<?php

use Illuminate\Support\Facades\Broadcast;


// Broadcast::channel('notifications.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


Broadcast::channel('alert.{id}', function ($user, $id) {
    return $user->role === 'admin' || (int) $user->id === (int) $id;
});

Broadcast::channel('venta_notifications.{id}', function ($user, $id) {
    return $user->role === 'admin' || ($user->role === null && (int) $user->id === (int) $id);
});


