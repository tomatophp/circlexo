<?php
namespace Modules\TomatoCategory\App\Services;

use Illuminate\Support\Collection;
use Modules\TomatoCategory\App\Services\Contracts\Type;

class TomatoCategoryHandler
{
    /**
     * @var array|null
     */
    public ?Collection $types;

    public function __construct()
    {
        $this->types = collect([]);
    }

    /**
     * @param string $item
     * @return void
     */
    public function register(array|Type $item): static
    {
        if(is_array($item)){
           foreach ($item as $typeItem) {
                $this->types->push($typeItem);
           }
        }
        else {
            $this->types->push($item);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function load(): Collection
    {
        return $this->types;
    }

    public function get(): Collection
    {
        return CategoryServices::get();
    }
}
