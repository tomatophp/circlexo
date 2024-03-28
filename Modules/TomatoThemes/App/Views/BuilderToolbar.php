<?php

namespace Modules\TomatoThemes\App\Views;

use Illuminate\View\Component;
use Modules\TomatoCms\App\Models\Page;
use Modules\TomatoThemes\App\Services\Abstract\Section;

class BuilderToolbar extends Component
{
    public function __construct(
        public Page $page
    )
    {
        //
    }

    public function render()
    {
       return view('tomato-themes::themes.builder-toolbar');
    }
}
