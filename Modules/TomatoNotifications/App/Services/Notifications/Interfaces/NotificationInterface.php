<?php

namespace Modules\TomatoNotifications\App\Services\Notifications\Interfaces;

interface NotificationInterface
{
    public function send(array $notified, array $replacements = []);
}
