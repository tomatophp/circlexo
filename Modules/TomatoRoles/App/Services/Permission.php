<?php

namespace Modules\TomatoRoles\App\Services;

class Permission
{
    /**
     * @var string
     */
    public string $group;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $guard;

    /**
     * @return static
     */
    public static function make(): static
    {
        return (new static);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array([
            "group" => $this->group ?? null,
            "name" => $this->name ?? null,
            "guard_name" => $this->guard ?? null,
        ]);
    }


    /**
     * @param string $group
     * @return $this
     */
    public function group(string $group): static
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $guard
     * @return $this
     */
    public function guard(string $guard): static
    {
        $this->guard = $guard;
        return $this;
    }
}
