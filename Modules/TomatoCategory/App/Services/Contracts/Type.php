<?php

namespace Modules\TomatoCategory\App\Services\Contracts;

class Type
{
    public string $label;
    public string $for;
    public string $type;
    public string $back;

    public static function make(): self
    {
        return new self();
    }


    public function back(string $back): self
    {
        $this->back = $back;
        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function for(string $for): self
    {
        $this->for = $for;
        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
