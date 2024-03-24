<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\TomatoCrm\App\Models\Account;

class PublicProfileLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Account $account
    )
    {

    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.layout.public-profile');
    }
}
