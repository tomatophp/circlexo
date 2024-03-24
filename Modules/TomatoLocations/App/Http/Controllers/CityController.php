<?php

namespace Modules\TomatoLocations\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoLocations\App\Models\City;
use Modules\TomatoLocations\App\Tables\CityTable;

class CityController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = City::class;
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
            view: 'tomato-locations::cities.index',
            table: CityTable::class,
            filters: [
                "country_id"
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
            'country_id' => 'required|integer|exists:countries,id'
        ]);


        $query = \Modules\TomatoLocations\App\Models\City::query();
        $query->where('country_id', $request->get('country_id'));

        return Tomato::json(
            request: $request,
            model: $this->model,
            query: $query
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-locations::cities.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: $this->model,
            validation: [
                'name' => 'required|max:255|string',
                'price' => 'nullable',
                'shipping' => 'nullable',
                'country_id' => 'required',
                'lat' => 'nullable|max:255|string',
                'lang' => 'nullable|max:255|string'
            ],
            message: __('City updated successfully'),
            redirect: 'admin.cities.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\Locations\Entities\City $model
     * @return View|JsonResponse
     */
    public function show(City $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::cities.show',
        );
    }

    /**
     * @param \Modules\Locations\Entities\City $model
     * @return View
     */
    public function edit(City $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::cities.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\Locations\Entities\City $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, City $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'name' => 'sometimes|max:255|string',
                'price' => 'nullable',
                'shipping' => 'nullable',
                'country_id' => 'sometimes',
                'lat' => 'nullable|max:255|string',
                'lang' => 'nullable|max:255|string'
            ],
            message: __('City updated successfully'),
            redirect: 'admin.cities.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\Locations\Entities\City $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(City $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('City deleted successfully'),
            redirect: 'admin.cities.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }
}

