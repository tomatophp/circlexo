<?php

namespace Modules\TomatoMenus\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use Modules\TomatoMenus\App\Models\Menu;
use Modules\TomatoMenus\App\Models\MenusItem;

class MenuController extends Controller
{

    public function index(Request $request): Application|Factory|View
    {
        $menus = Menu::all();
        if(!$request->has('create_new')){
            if($request->has('menu_id')){
                $menu = Menu::find((int)$request->get('menu_id'));
            }
            else {
                $menu = Menu::all()->last();
            }

        }
        else {
            $menu = false;
        }

        $menusItems = $menu ? $menu->menusItems()->with('children')->where('parent_id', null)->orderBy('order', 'asc')->get() : [];

        $pages = TomatoMenu::get();
        return view('tomato-menus::index', compact('menus', 'menu', 'menusItems', 'pages'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: Menu::class,
        );
    }


    public function pages(Request $request, Menu $menu){
        $getGroup = TomatoMenu::get();

        foreach($getGroup as $key=>$value){
            if($request->get(Str::of($key)->replace(' ','_')) == 1){
                $menuItem = new MenusItem();
                $menuItem->name =  [
                    "ar" => $key,
                    "en" => $key,
                ];
                $menuItem->url = $key;
                $menuItem->menu_id = $menu->id;
                $menuItem->order = MenusItem::where('menu_id', $menu->id)->first() ? (MenusItem::where('menu_id', $menu->id)->first()->order + 1 ) : 0;
                $menuItem->save();

                $counter = 0;
                foreach($value as $item){
                    if(isset($item->label)){
                        $menuCh = new MenusItem();
                        $menuCh->name =  [
                            "ar" => $item->label,
                            "en" => $item->label
                        ];
                        $menuCh->icon =  $item->icon;
                        $menuCh->url = $item->route ? route($item->route) : $item->url;
                        $menuCh->menu_id = $menu->id;
                        $menuCh->parent_id = $menuItem->id;
                        $menuCh->order = $counter;
                        $menuCh->save();
                    }

                    $counter++;
                }
            }
        }

        Toast::success(__('Plugin Added Successfully'))->autoDismiss(2);
        return back();
    }

    public function itemAll(Request $request, Menu $menu){
        $request->validate([
            "all" => "required|array",
            "orderBy" => "required|string",
        ]);

        $counter = 0;
        foreach($request->get('all') as $key=>$item){
            $menuItem = MenusItem::where('id', $item['id'])->first();
            $menuItem->{$request->get('orderBy')} = $counter;
            $menuItem->save();



            if(isset($item['children']) && count($item['children'])){
                $countChild = 0;
                foreach($item['children'] as $key=>$child){
                    $childItem = MenusItem::where('id', $child['id'])->first();
                    $childItem->parent_id = $menuItem->id;
                    $childItem->{$request->get('orderBy')} = $countChild;
                    $childItem->save();

                    $countChild++;

                    if(isset($child['children']) && count($child['children'])){
                        $this->setChildren($child, $childItem);
                    }
                }
            }
            else {
                $menuItem->parent_id = null;
                $menuItem->save();
            }
            $counter++;
        }

        return back();
    }

    /**
     * @param $item
     * @param $parent
     * @return void
     */
    public function setChildren($item, $parent): void
    {
        $countChild = 0;
        foreach($item['children'] as $key=>$child){
            $childItem = MenusItem::where('id', $child['id'])->first();
            $childItem->parent_id = $parent->id;
            $childItem->order = $countChild;
            $childItem->save();

            if(isset($child['children']) && count($child['children'])){
                $this->setChildren($child, $childItem);
            }

            $countChild++;
        }
    }

    public function item(Request $request, Menu $menu){
        $request->validate([
            "name" => "required|string|max:255",
            "url" => "required|string|max:255",
        ]);

        $item = new MenusItem();
        $item->name =  $request->get('name');
        $item->url = $request->get('url');
        $item->menu_id = $menu->id;
        $item->order = MenusItem::where('menu_id', $menu->id)->first() ? (MenusItem::where('menu_id', $menu->id)->first()->order + 1 ) : 0;
        $item->save();

        Toast::success(__('Your Menu Item Added Success'))->autoDismiss(2);
        return back();
    }

    public function itemDestroy(Request $request, Menu $menu){
        $menusItem = MenusItem::find($request->get('id'));
        $menusItem->children()->delete();
        $menusItem->delete();

        Toast::success(__('Your Menu Item Deleted Success'))->autoDismiss(2);
        return back();
    }

    public function itemUpdate(Request $request, Menu $menu){
        $menusItem = MenusItem::find($request->get('id'));

        $request->validate([
            "name" => "required|array|max:255",
            "url" => "required|string|max:255",
        ]);

        $menusItem->name =  $request->get('name') ?: null;
        $menusItem->url = $request->get('url') ?: null;
        $menusItem->icon = $request->get('icon') ?: null;
        $menusItem->target = $request->get('target') ?: null;
        $menusItem->parent_id = $request->get('parent_id') ?: null;
        $menusItem->description = $request->get('description') ?: null;
        if($request->has('order')){
            $menusItem->order = $request->get('order');
        }
        $menusItem->save();

        Toast::success(__('Your Menu Item Updated Success'))->autoDismiss(2);
        return back();
    }


    public function store(Request $request){
        $request->validate([
           "name" => "required|array",
           "name*" => "required|string|max:255"
        ]);

        $exists = Menu::where('key', Str::of($request->get('name')[app()->getLocale()])->lower()->slug('-'))->first();

        if($exists){
            Toast::danger(__('Sorry Menu Is Exists'))->autoDismiss(2);
            return back();
        }

        $menu = Menu::create([
            "name" => $request->get('name'),
            "key" => Str::of($request->get('name')[app()->getLocale()])->lower()->slug('-'),
            "auto_add_pages" => 0,
            "locations" => [],
        ]);

         Toast::success(__('Your Menu Added Success'))->autoDismiss(2);
         return redirect()->route('admin.menus.index');
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return RedirectResponse
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $request->validate([
            "name" => "sometimes|string|max:255",
            "auto_add_pages" => "sometimes|boolean",
            "locations" => "nullable|array",
        ]);

       $locations = collect($request->get('locations'))->map(function ($location){
           return $location === '1' ? true : false;
       });
        $menu->update([
            "name" => $request->get('name'),
            "key" => Str::of($request->get('name'))->lower()->slug('-'),
            "auto_add_pages" => $request->get('auto_add_pages'),
            "locations" => $locations ?: [],
        ]);

        Toast::success(__('Your Menu Updated Success'))->autoDismiss(2);
        return back();
    }

    /**
     * @param Menu $menu
     * @return RedirectResponse
     */
    public function destroy(Menu $menu): RedirectResponse
    {

        $menu->delete();

        Toast::success(__('Your Menu Deleted Success'))->autoDismiss(2);
        return redirect()->route('admin.menus.index');
    }

}
