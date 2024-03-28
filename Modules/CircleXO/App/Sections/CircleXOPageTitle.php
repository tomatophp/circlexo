<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOPageTitle extends Section
{
    public ?string $label = null;
    public ?string $group = "pages";
    public ?string $icon = "bx bx-bold";
    public ?string $description = "add a title for a page and some informations about current page";

    public function label(): string
    {
        return __('CircleXO Page Title');
    }

    public function form(): string
    {
        return 'circle-xo::sections.forms.page-header';
    }

    public function section(): string
    {
        return 'circle-xo::sections.page-header';
    }

    public function config(): array
    {
        return [];
    }
}
