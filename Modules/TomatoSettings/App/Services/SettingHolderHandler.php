<?php

namespace Modules\TomatoSettings\App\Services;

use Illuminate\Support\Collection;
use Modules\TomatoSettings\App\Facades\TomatoSettings;
use Modules\TomatoSettings\App\Services\Contracts\SettingHold;

class SettingHolderHandler
{
    /**
     * @var array|null
     */
    public ?Collection $settings;

    public function __construct()
    {
        $this->settings = collect([]);
    }

    /**
     * @param string $item
     * @return void
     */
    public function register(array|SettingHold $item): static
    {

        if(is_array($item)){
            foreach ($item as $settingItem) {
                $this->settings->push($settingItem);
            }
        }
        else {
            $this->settings->push($item);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function load(): Collection
    {
        return $this->settings;
    }

    public function get(): Collection
    {
        return TomatoSettings::get();
    }
}
