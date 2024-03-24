<?php

namespace Modules\TomatoCategory\App\Services;

use Illuminate\Support\Collection;
use TomatoPHP\TomatoAdmin\Facade\TomatoWidget as TomatoWidgetFacade;
use Modules\TomatoCategory\App\Facades\TomatoCategory;
use Modules\TomatoCategory\App\Services\Contracts\LoadControllerFunctions;
use Modules\TomatoCategory\App\Services\Contracts\LoadRoutes;
use Modules\TomatoCategory\App\Services\Contracts\RegisterNewType;

class CategoryServices
{
    use LoadControllerFunctions;
    use LoadRoutes;

    public Collection $types;

    public function __construct()
    {
        $this->types = collect([]);
    }

    public function loadFromSource(): static
    {
        $this->types = TomatoCategory::load();
        return $this;
    }

    /**
     * @return Collection
     */
    public static function get(): Collection
    {
         return (new static)->loadFromSource()->build()->load();
    }

    /**
     * @return Collection
     */
    public function load(): Collection
    {
        return $this->types;
    }

    /**
     * @return $this
     */
    private function build(): static
    {
        $this->types = $this->types;
        return $this;
    }
}
