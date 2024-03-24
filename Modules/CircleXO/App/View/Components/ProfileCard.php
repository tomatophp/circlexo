<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Account;

class ProfileCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Account $account
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.profile-card');
    }
}
