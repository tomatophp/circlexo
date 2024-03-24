<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class NotificationsSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('notifications.notifications_allow', false);
        $this->migrator->add('notifications.fcm_apiKey', '');
        $this->migrator->add('notifications.fcm_authDomain', '');
        $this->migrator->add('notifications.fcm_projectId', '');
        $this->migrator->add('notifications.fcm_storageBucket', '');
        $this->migrator->add('notifications.fcm_messagingSenderId', '');
        $this->migrator->add('notifications.fcm_appId', '');
        $this->migrator->add('notifications.fcm_measurementId', '');
    }
}
