<?php

namespace Modules\TomatoNotifications\App\Services\Notifications\Interfaces;

interface INotification
{
    public function send($event):void;
}
