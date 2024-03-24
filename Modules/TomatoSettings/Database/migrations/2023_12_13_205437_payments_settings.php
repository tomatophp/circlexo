<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('payments.payment_gate', 'paytabs');
        $this->migrator->add('payments.payment_online', false);
        $this->migrator->add('payments.payment_vendors', []);
    }
};
