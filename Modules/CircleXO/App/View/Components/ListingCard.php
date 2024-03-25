<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\CircleXO\App\Models\AccountListing;

class ListingCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public AccountListing $item,
        public ?bool $edit = false,
        public ?string $link = null
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.listing-card');
    }
}
