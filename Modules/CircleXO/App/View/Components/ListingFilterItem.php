<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ListingFilterItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $filter='link',
        public string $color='text-white',
        public string $icon='bx bx-link',
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.listing-filter-item');
    }
}
