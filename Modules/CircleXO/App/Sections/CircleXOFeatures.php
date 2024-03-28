<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOFeatures extends Section
{
    public ?string $label = null;
    public ?string $group = "home";
    public ?string $icon = "bx bx-question-mark";
    public ?string $description = "show all FAQ questions with pagination";

    public function label(): string
    {
        return __('CircleXO Features');
    }

    public function form(): string
    {
        return 'circle-xo::sections.forms.features';
    }

    public function section(): string
    {
        return 'circle-xo::sections.features';
    }

    public function config(): array
    {
        return [];
    }
}
