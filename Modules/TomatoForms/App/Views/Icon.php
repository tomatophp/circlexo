<?php

namespace Modules\TomatoForms\App\Views;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Icon extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $icon,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('tomato-forms::components.icon');
    }
}
