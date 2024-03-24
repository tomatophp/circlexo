<?php

namespace Modules\TomatoSettings\App\Views;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * @var string|null
     */
    public string|null $title = null;

    /**
     * @var string|null
     */
    public string|null $description = null;

    public function __construct(string|null $title=null,string|null $description=null)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('tomato-settings::components.card');
    }
}
