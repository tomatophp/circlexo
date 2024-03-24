<?php

namespace Modules\TomatoRoles\App\Views;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logout extends Component
{
    /**
     * @return \Closure|Application|Htmlable|Factory|View|string
     */
    public function render(): \Closure|Application|Htmlable|Factory|View|string
    {
        return view('tomato-roles::components.logout');
    }
}
