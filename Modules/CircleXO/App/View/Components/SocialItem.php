<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SocialItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $network,
        public string $label,
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.social-item');
    }
}
