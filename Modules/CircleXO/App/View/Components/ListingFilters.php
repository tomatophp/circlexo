<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ListingFilters extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $link=false,
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.listing-filters');
    }
}
