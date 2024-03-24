<?php

namespace Modules\TomatoCrm\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoCrm\App\Models\Location;

class LocationController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: Location::class,
            view: 'tomato-crm::locations.index',
            table: \Modules\TomatoCrm\App\Tables\LocationTable::class,
            filters: [
                "account_id"
            ]
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
            model: \Modules\TomatoCrm\App\Models\Location::class,
            filters: [
                "account_id"
            ]
        );
    }

    /**
     * @return View
     */
    public function create(Request $request): View|JsonResponse
    {
        $accountId = null;
        if($request->has('account_id') && !empty($request->get('account_id'))){
            $accountId = $request->get('account_id');
        }
        return Tomato::create(
            view: 'tomato-crm::locations.create',
            data: [
                "account_id"=>  $accountId
            ]
        );
    }

    /**
     * @param \Modules\TomatoCrm\App\Http\Requests\Location\LocationStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\Modules\TomatoCrm\App\Http\Requests\Location\LocationStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoCrm\App\Models\Location::class,
            message: __('Location created successfully'),
            redirect: 'admin.locations.index',
        );

        return back();
    }

    /**
     * @param \Modules\TomatoCrm\App\Models\Location $model
     * @return View
     */
    public function show(\Modules\TomatoCrm\App\Models\Location $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::locations.show',
        );
    }

    /**
     * @param \Modules\TomatoCrm\App\Models\Location $model
     * @return View
     */
    public function edit(\Modules\TomatoCrm\App\Models\Location $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::locations.edit',
        );
    }

    /**
     * @param \Modules\TomatoCrm\App\Http\Requests\Location\LocationUpdateRequest $request
     * @param \Modules\TomatoCrm\App\Models\Location $user
     * @return RedirectResponse
     */
    public function update(\Modules\TomatoCrm\App\Http\Requests\Location\LocationUpdateRequest $request, \Modules\TomatoCrm\App\Models\Location $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Location updated successfully'),
            redirect: 'admin.locations.index',
        );

        return back();
    }

    /**
     * @param \Modules\TomatoCrm\App\Models\Location $model
     * @return RedirectResponse
     */
    public function destroy(\Modules\TomatoCrm\App\Models\Location $model): RedirectResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Location deleted successfully'),
            redirect: 'admin.locations.index',
        );

        return $response->redirect;
    }
}
