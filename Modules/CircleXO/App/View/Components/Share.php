<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\CircleXO\App\Models\AccountListing;

class Share extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public ?string $description=null,
        public ?string $url=null,
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.share');
    }
}
