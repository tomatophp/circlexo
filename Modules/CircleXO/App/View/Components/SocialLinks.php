<?php

namespace Modules\CircleXO\App\View\Components;

use App\Models\Account;
use Illuminate\View\Component;
use Illuminate\View\View;

class SocialLinks extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Account $account,
        public bool $edit = false,
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.social-links');
    }
}
