<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('accounts.{id}', function ($user, $id) {
    return $user;
}, ['guards' => ['accounts']]);
