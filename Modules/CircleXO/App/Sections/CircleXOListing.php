<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOListing extends Section
{
    public ?string $label = null;
    public ?string $group = "home";
    public ?string $icon = "bx bx-question-mark";
    public ?string $description = "show all FAQ questions with pagination";

    public function label(): string
    {
        return __('CircleXO Listing');
    }

    public function form(): string
    {
        return 'circle-xo::sections.forms.listing';
    }

    public function section(): string
    {
        return 'circle-xo::sections.listing';
    }

    public function config(): array
    {
        return [];
    }
}
