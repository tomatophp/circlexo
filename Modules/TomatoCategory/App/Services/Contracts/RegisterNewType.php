<?php

namespace Modules\TomatoCategory\App\Services\Contracts;

use Illuminate\Support\Collection;

trait RegisterNewType
{

    public function registerNewType(array|string $type): void
    {
        if(is_string($type)){
            $this->types->push($type);
        }
        else {
            $this->types->merge($type);
        }
    }


    public function loadTypes(): Collection
    {
        return $this->types;
    }
}
