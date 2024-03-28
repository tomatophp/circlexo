<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOHeader extends Section
{
    public ?string $label = null;
    public ?string $group = "header";
    public ?string $icon = "bx bx-menu";
    public ?string $description = "main header for any page as a layout header";

    public function label(): string
    {
        return __('CircleXO Header');
    }

    public function form(): string
    {
        return '';
    }

    public function section(): string
    {
        return 'circle-xo::sections.header';
    }

    public function config(): array
    {
        return [];
    }
}
