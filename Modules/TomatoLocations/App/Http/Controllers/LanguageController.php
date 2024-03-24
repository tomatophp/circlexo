<?php

namespace Modules\TomatoLocations\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class LanguageController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoLocations\App\Models\Language::class;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-locations::languages.index',
            table: \Modules\TomatoLocations\App\Tables\LanguageTable::class,
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
            model: \Modules\TomatoLocations\App\Models\Language::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-locations::languages.create',
        );
    }


    public function store(\Modules\TomatoLocations\App\Http\Requests\Language\LanguageStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: $this->model,
            message: __('Langauge Updated successfully'),
            redirect: 'admin.languages.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Language $model
     * @return View
     */
    public function show(\Modules\TomatoLocations\App\Models\Language $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::languages.show',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Language $model
     * @return View
     */
    public function edit(\Modules\TomatoLocations\App\Models\Language $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-locations::languages.edit',
        );
    }

    /**
     * @param \Modules\TomatoLocations\App\Http\Requests\Language\LanguageUpdateRequest $request
     * @param \Modules\TomatoLocations\App\Models\Language $user
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\TomatoLocations\App\Http\Requests\Language\LanguageUpdateRequest $request, \Modules\TomatoLocations\App\Models\Language $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: trans('tomato-locations::global.language.message.update'),
            redirect: 'admin.languages.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoLocations\App\Models\Language $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoLocations\App\Models\Language $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: trans('tomato-locations::global.language.message.delete'),
            redirect: 'admin.languages.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
