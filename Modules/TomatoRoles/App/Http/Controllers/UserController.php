<?php

namespace Modules\TomatoRoles\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoRoles\App\Http\Requests\User\UserStoreRequest;
use Modules\TomatoRoles\App\Http\Requests\User\UserUpdateRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            model: User::class,
            view: 'tomato-roles::users.index',
            table: \Modules\TomatoRoles\App\Tables\UserTable::class,
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
            model: User::class,
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('tomato-roles::users.create', [
            "roles" => Role::all()
        ]);
    }

    /**
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $request->merge([
            "password" => bcrypt($request->get('password'))
        ]);

        $response = Tomato::store(
            request: $request,
            model: \App\Models\User::class,
            message: trans('tomato-roles::global.users.messages.created'),
            redirect: 'admin.users.index',
        );

        if($request->has('roles') && count($request->get('roles'))){
            $response->record->roles()->attach($request->get('roles'));
        }

        return $response->redirect;
    }

    /**
     * @param User $model
     * @return View
     */
    public function show(User $model): View
    {
        $model->load('roles');

        return Tomato::get(
            model: $model,
            view: 'tomato-roles::users.show',
        );
    }

    /**
     * @param User $model
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $model): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $model->load('roles');

        return view('tomato-roles::users.edit', [
            "model" => $model,
            "roles" => Role::all()
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $model
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $model): RedirectResponse
    {
        $record = [
            "name" => $request->get('name'),
            "email" => $request->get('email'),
        ];

        if(!empty($request->get('password'))){
            $record['password'] = bcrypt($request->get('password'));
        }

        $model->update($record);

        $model->roles()->sync($request->get('roles'));

        Toast::title( trans('tomato-roles::global.users.messages.updated'))->success()->autoDismiss(2);
        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $model
     * @return RedirectResponse
     */
    public function destroy(User $model): RedirectResponse
    {
        $model->roles()->sync([]);

        $response = Tomato::destroy(
            model: $model,
            message: trans('tomato-roles::global.users.messages.deleted'),
            redirect: 'admin.users.index',
        );

        return $response->redirect;
    }
}
