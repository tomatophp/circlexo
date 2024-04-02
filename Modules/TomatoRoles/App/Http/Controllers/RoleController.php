<?php

namespace Modules\TomatoRoles\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoRoles\App\Http\Requests\Role\RoleStoreRequest;
use Modules\TomatoRoles\App\Http\Requests\Role\RoleUpdateRequest;
use Modules\TomatoRoles\App\Services\TomatoRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            model: Role::class,
            view: 'tomato-roles::roles.index',
            table: \Modules\TomatoRoles\App\Tables\RoleTable::class,
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: Role::class,
        );
    }

    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     * @throws Exception
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $permissionNames = array_values(Permission::get('name')->map(fn($item)=>$item->name)->toArray());
        return view('tomato-roles::roles.create', [
            "perm" => $this->getPermGroup(),
            "permissionNames" => $permissionNames
        ]);
    }

    /**
     * @param RoleStoreRequest $request
     * @return RedirectResponse
     */
    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: Role::class,
            message: 'Role created successfully',
            redirect: 'admin.roles.index',
        );


        foreach($request->get('permissions') as $item){
            Permission::findOrCreate($item);
        }
        //Get Permission By Id from $request->roles
        $response->record->syncPermissions(array_values($request->get('permissions')));

        return $response->redirect;
    }

    /**
     * @param Role $model
     * @return View
     */
    public function show(Role $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-roles::roles.show',
        );
    }


    /**
     * @param Role $model
     * @return Application|Factory|\Illuminate\Contracts\View\View
     * @throws Exception
     */
    public function edit(Role $model): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $permissions = $model->permissions->map(function($item){
            return $item->name;
        })->toArray();

        $model->permissions = $permissions;

        $permissionNames = array_values(Permission::get('name')->map(fn($item)=>$item->name)->toArray());

        return view('tomato-roles::roles.edit', [
            "model" =>$model,
            "permissionNames" =>$permissionNames,
            "perm" => $this->getPermGroup()
        ]);
    }

    /**
     * @param RoleUpdateRequest $request
     * @param Role $model
     * @return RedirectResponse
     */
    public function update(RoleUpdateRequest $request, Role $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: 'Role updated successfully',
            redirect: 'admin.roles.index',
        );

        //Get Permission By Id from $request->roles
        if ($request->get('permissions')) {
            foreach($request->get('permissions') as $item){
                Permission::findOrCreate($item);
            }
            $response->record->syncPermissions(array_values($request->get('permissions')));
        }
        else {
            $response->record->syncPermissions([]);
        }

        return $response->redirect;
    }

    /**
     * @param Role $model
     * @return RedirectResponse
     */
    public function destroy(Role $model): RedirectResponse
    {
        if($model->name === 'admin'){
            Toast::warning(__('You Can not delete admin role'))->autoDismiss(2000);
            return back();
        }
        else {
            $model->syncPermissions([]);

            $response = Tomato::destroy(
                model: $model,
                message: 'Role deleted successfully',
                redirect: 'admin.roles.index',
            );

            return $response->redirect;
        }

    }

    /**
     * @return array
     * @throws Exception
     */
    public function getPermGroup(): array
    {
        $prem = Permission::all()->makeHidden(['pivot', 'created_at', 'updated_at']);

        $tables = array_map('current', DB::select('SHOW TABLES'));

        $permGroup = [];
        foreach ($tables as $item) {
            $permGroupGet = [];
            foreach ($prem as $key => $p) {
                if (str_contains($p->name, Str::replace('_', '-', $item)) && $p->guard_name == 'web') {
                    $p->table = $item;
                    $permGroupGet[] = $p->toArray();
                }
            }

            if (count($permGroupGet) > 0) {
                $permGroup[$item] = $permGroupGet;
            }
        }
        $getCustomPermArray = config('tomato-roles.custom');
        $customPerm = [];
        foreach ($getCustomPermArray as $key=>$item){
            $customPerm[$key] = [];
            foreach($item as $perm){
                $customPerm[$key][] = [
                    'name' => $perm,
                    'guard_name' => "web",
                    'table' => $key,
                ];
            }

        }

        $providerRoles = TomatoRoles::loadPermission();

        $permGroup = array_merge($permGroup, $customPerm, $providerRoles);

        return $permGroup;
    }
}
