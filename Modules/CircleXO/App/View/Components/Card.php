<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $title=null,
        public ?string $description=null,
        public ?string $icon=null,
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.card');
    }
}
