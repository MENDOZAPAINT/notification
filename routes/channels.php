<?php

use Illuminate\Support\Facades\Broadcast;
// TODOS ESTOS SON CANALES PRIVADOS

Broadcast::channel('alert.{id}', function ($user, $id) {
    return $user->role === 'admin' || (int) $user->id === (int) $id;
});

Broadcast::channel('venta_notifications.{userId}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


