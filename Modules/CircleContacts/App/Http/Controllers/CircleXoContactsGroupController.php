<?php

namespace Modules\CircleContacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoContactsGroupController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleContacts\App\Models\CircleXoContactsGroup::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'circle-contacts::groups.index',
            table: \Modules\CircleContacts\App\Tables\CircleXoContactsGroupTable::class
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
            model: \Modules\CircleContacts\App\Models\CircleXoContactsGroup::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circle-contacts::groups.create',
        );
    }

    /**
     * @param \Modules\CircleContacts\App\Http\Requests\CircleXoContactsGroup\CircleXoContactsGroupStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\Modules\CircleContacts\App\Http\Requests\CircleXoContactsGroup\CircleXoContactsGroupStoreRequest $request): RedirectResponse|JsonResponse
    {
        $request->merge([
            "account_id" => auth('accounts')->user()->id
        ]);

        $response = Tomato::store(
            request: $request,
            model: \Modules\CircleContacts\App\Models\CircleXoContactsGroup::class,
            message: __('Group saved successfully'),
            redirect: 'profile.groups.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContactsGroup $model
     * @return View|JsonResponse
     */
    public function show(\Modules\CircleContacts\App\Models\CircleXoContactsGroup $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'circle-contacts::groups.show',
        );
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContactsGroup $model
     * @return View
     */
    public function edit(\Modules\CircleContacts\App\Models\CircleXoContactsGroup $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'circle-contacts::groups.edit',
        );
    }

    /**
     * @param \Modules\CircleContacts\App\Http\Requests\CircleXoContactsGroup\CircleXoContactsGroupUpdateRequest $request
     * @param \Modules\CircleContacts\App\Models\CircleXoContactsGroup $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\CircleContacts\App\Http\Requests\CircleXoContactsGroup\CircleXoContactsGroupUpdateRequest $request, \Modules\CircleContacts\App\Models\CircleXoContactsGroup $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Group updated successfully'),
            redirect: 'profile.groups.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return back();
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContactsGroup $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleContacts\App\Models\CircleXoContactsGroup $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Group deleted successfully'),
            redirect: 'profile.groups.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return redirect()->route('profile.contacts.index');
    }
}
