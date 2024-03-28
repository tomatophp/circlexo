<?php

namespace Modules\TomatoMenus\App\Services;

use Modules\TomatoMenus\App\Models\Menu;

class MenuRenderBase {
    public static function menu($key, $by = 'key')
    {
        $menus  = Menu::where($by, $key)->with('menusItems', function ($q){
            $q->where('parent_id', null)->with( 'children')->orderBy('order', 'asc');
        })->first();
        return $menus;
    }
    public static function render() {
        return view('tomato-menus::menu', [
            "menus" => self::menu('dashboard')->menusItems ?: []
        ])->render();
    }
}
