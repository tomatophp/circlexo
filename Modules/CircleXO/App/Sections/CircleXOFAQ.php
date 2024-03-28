<?php

namespace Modules\CircleXO\App\Sections;

use Modules\TomatoThemes\App\Services\Abstract\Section;

class CircleXOFAQ extends Section
{
    public ?string $label = null;
    public ?string $group = "support";
    public ?string $icon = "bx bx-question-mark";
    public ?string $description = "show all FAQ questions with pagination";

    public function label(): string
    {
        return __('CircleXO FAQ');
    }

    public function form(): string
    {
        return 'circle-xo::sections.forms.faq';
    }

    public function section(): string
    {
        return 'circle-xo::sections.faq';
    }

    public function config(): array
    {
        return [];
    }
}
