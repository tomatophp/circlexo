<?php


use Modules\TomatoCrm\App\Facades\ActionFacade as Action;
use Modules\TomatoCrm\App\Facades\FilterFacade as Filter;

if (! function_exists('add_filter')) {
    function add_filter(string|array|null $hook, string|array|Closure $callback, int $priority = 20, int $arguments = 1): void
    {
        Filter::addListener($hook, $callback, $priority, $arguments);
    }
}

if (! function_exists('apply_filters')) {
    function apply_filters()
    {
        $args = func_get_args();

        return Filter::fire(array_shift($args), $args);
    }
}


if (! function_exists('add_action')) {
    function add_action(string|array|null $hook, string|array|Closure $callback, int $priority = 20, int $arguments = 1): void
    {
        Action::addListener($hook, $callback, $priority, $arguments);
    }
}

if (! function_exists('do_action')) {
    function do_action(): void
    {
        $args = func_get_args();
        Action::fire(array_shift($args), $args);
    }
}

if (! function_exists('get_hooks')) {
    function get_hooks(?string $name = null, bool $isFilter = true): array
    {
        if ($isFilter) {
            $listeners = Filter::getListeners();
        } else {
            $listeners = Action::getListeners();
        }

        if (empty($name)) {
            return $listeners;
        }

        return Arr::get($listeners, $name, []);
    }
}
