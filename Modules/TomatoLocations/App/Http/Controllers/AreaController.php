<?php

namespace Modules\TomatoLocations\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoLocations\App\Models\Area;
use Modules\TomatoLocations\App\Tables\AreaTable;

class AreaController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = Area::class;
    }


    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-locations::areas.index',
            table: \Modules\TomatoLocations\App\Tables\AreaTable::class,
            filters: [
                "city_id"
            ]
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        $request->validate([
           'city_id' => 'required|integer|exists:cities,id'
        ]);

        $query = \Modules\TomatoLocations\App\Models\Area::query();
        $query->where('city_id', $request->get('city_id'));

        return Tomato::json(
            request: $request,
            model: \Modules\TomatoLocations\App\Models\Area::class,
            query: $query,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-locations::areas.create',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Http\Requests\Area\AreaStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\Modules\TomatoLocations\App\Http\Requests\Area\AreaStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoLocations\App\Models\Area::class,
            message: trans('tomato-locations::global.area.message.store'),
            redirect: 'admin.areas.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Area $model
     * @return View
     */
    public function show(\Modules\TomatoLocations\App\Models\Area $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::areas.show',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Area $model
     * @return View
     */
    public function edit(\Modules\TomatoLocations\App\Models\Area $model): View
    {
        $model->country_id = $model->city->country_id;
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::areas.edit',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Http\Requests\Area\AreaUpdateRequest $request
     * @param \Modules\TomatoLocations\App\Models\Area $user
     * @return RedirectResponse
     */
    public function update(\Modules\TomatoLocations\App\Http\Requests\Area\AreaUpdateRequest $request, \Modules\TomatoLocations\App\Models\Area $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: trans('tomato-locations::global.area.message.update'),
            redirect: 'admin.areas.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Area $model
     * @return RedirectResponse
     */
    public function destroy(\Modules\TomatoLocations\App\Models\Area $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: trans('tomato-locations::global.area.message.delete'),
            redirect: 'admin.areas.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }
}
