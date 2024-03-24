<?php

namespace Modules\TomatoLocations\App\Views;

use Illuminate\View\Component;

class Location extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('tomato-locations::components.location');
    }

}
