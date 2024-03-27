<?php

namespace Modules\TomatoCms\App\Services;

use Modules\TomatoCms\App\Services\Contracts\Page;
use Modules\TomatoCms\App\Services\Contracts\Section;
use Modules\TomatoForms\App\Models\Form;

class TomatoCmsRegister
{
    public $pages = [];
    public $sections = [];

    public function registerPage(Page $page): void
    {
        $this->pages[] = $page;
    }

    public function getPages(): array
    {
        return $this->pages;
    }

    public function build(): void
    {
        foreach ($this->pages as $page) {
            $checkIfPageExists = \Modules\TomatoCms\App\Models\Page::where('slug', $page->slug)->first();
            if(!$checkIfPageExists){
                \Modules\TomatoCms\App\Models\Page::create($page->toArray());
            }
        }
    }

}
