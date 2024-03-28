<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOPageBody extends Section
{
    public ?string $label = null;
    public ?string $group = "pages";
    public ?string $icon = "bx bx-text";
    public ?string $description = "use to get the body of the page inside your page builder";

    public function label(): string
    {
        return __('CircleXO Page Body');
    }

    public function form(): string
    {
        return '';
    }

    public function section(): string
    {
        return 'circle-xo::sections.page-body';
    }

    public function config(): array
    {
        return [];
    }
}
