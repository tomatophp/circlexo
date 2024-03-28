<?php

if(!function_exists('menu')){
    function menu($key){
        return \Modules\TomatoMenus\App\Models\Menu::where('key', $key)
            ->with('menusItems')
            ->first()?->menusItems()->orderBy('order', 'asc')->get() ?: [];
    }
}
