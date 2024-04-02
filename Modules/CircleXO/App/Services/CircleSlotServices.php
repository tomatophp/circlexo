<?php

namespace Modules\CircleXo\App\Services;

class CircleSlotServices
{
    private array $slots;
    private string $place = 'profile-filter-slider';

    public function __construct()
    {
        $this->slots = [];
    }

    /**
     * @param string|array $menus
     * @return void
     */
    public function register(string|array $menus): static
    {
        if(is_array($menus)) {
            foreach ($menus as $menu)
            $this->slots[$this->place] = $menu;
        } else {
            $this->slots[$this->place] = $menus;
        }

        return $this;
    }

    public function profileFilterSlider(): static
    {
        $this->place = 'profile-filter-slider';

        return $this;
    }

    /**
     * @return void
     */
    public function sideMenu():static
    {
        $this->place = 'side-menu';
        return $this;
    }


    /**
     * @return void
     */
    public function headerMenu():static
    {
        $this->place = 'header-menu';
        return $this;
    }

    public function profileButtons(): static
    {
        $this->place = 'profile-buttons';
        return $this;
    }

    public function profileDropdown(): static
    {
        $this->place = 'profile-dropdown';
        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->slots;
    }
}
