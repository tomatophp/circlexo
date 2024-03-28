<?php

namespace Modules\CircleApps\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\CircleApps\App\Models\App;
use Multicaret\Acquaintances\Traits\CanBeRated;

class AppCard extends Component
{
    use CanBeRated;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public App $item
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-apps::components.app-card', [
            'item' => $this->item,
        ]);
    }
}
