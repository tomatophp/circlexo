<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOFooter extends Section
{
    public ?string $label = null;
    public ?string $group = "footers";
    public ?string $icon = "bx bx-copyright";
    public ?string $description = "main footer for any page as a layout footer";

    public function label(): string
    {
        return __('CircleXO Footer');
    }

    public function form(): string
    {
        return '';
    }

    public function section(): string
    {
        return 'circle-xo::sections.footer';
    }

    public function config(): array
    {
        return [];
    }
}
