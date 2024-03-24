<?php

namespace Modules\TomatoSettings\App\Services;

use Modules\TomatoSettings\App\Facades\TomatoSettings;

class SettingHolder
{
    public Collection $settings;

    public function loadFromSource(): static
    {
        $this->settings = TomatoSettings::load();
        return $this;
    }

    /**
     * @return Collection
     */
    public static function get(): Collection
    {
        return (new static)->loadFromSource()->build()->load();
    }

    /**
     * @return Collection
     */
    public function load(): Collection
    {
        return $this->settings;
    }

    /**
     * @return $this
     */
    private function build(): static
    {
        $this->settings = $this->settings;
        return $this;
    }
}
