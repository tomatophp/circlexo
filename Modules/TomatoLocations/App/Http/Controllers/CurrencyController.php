<?php

namespace Modules\TomatoLocations\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CurrencyController extends Controller
{

    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoLocations\App\Models\Currency::class;
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
            view: 'tomato-locations::currencies.index',
            table: \Modules\TomatoLocations\App\Tables\CurrencyTable::class,
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
            model: \Modules\TomatoLocations\App\Models\Currency::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-locations::currencies.create',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Http\Requests\Currency\CurrencyStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\Modules\TomatoLocations\App\Http\Requests\Currency\CurrencyStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: $this->model,
            message: trans('tomato-locations::global.currency.message.store'),
            redirect: 'admin.currencies.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Currency $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoLocations\App\Models\Currency $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::currencies.show',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Currency $model
     * @return View
     */
    public function edit(\Modules\TomatoLocations\App\Models\Currency $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::currencies.edit',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Http\Requests\Currency\CurrencyUpdateRequest $request
     * @param \Modules\TomatoLocations\App\Models\Currency $user
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\TomatoLocations\App\Http\Requests\Currency\CurrencyUpdateRequest $request,
                           \Modules\TomatoLocations\App\Models\Currency                              $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: trans('tomato-locations::global.currency.message.update'),
            redirect: 'admin.currencies.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Currency $model
     * @return RedirectResponse
     */
    public function destroy(\Modules\TomatoLocations\App\Models\Currency $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: trans('tomato-locations::global.currency.message.delete'),
            redirect: 'admin.currencies.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }
}
