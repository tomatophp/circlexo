<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOHero extends Section
{
    public ?string $label = null;
    public ?string $group = "home";
    public ?string $icon = "bx bx-menu";
    public ?string $description = "main header for any page as a layout header";

    public function label(): string
    {
        return __('CircleXO Hero');
    }

    public function form(): string
    {
        return 'circle-xo::sections.forms.hero';
    }

    public function section(): string
    {
        return 'circle-xo::sections.hero';
    }

    public function config(): array
    {
        return [];
    }
}
