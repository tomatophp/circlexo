<?php

namespace Modules\TomatoThemes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class FeatureController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoThemes\App\Models\Feature::class;
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
            view: 'tomato-themes::features.index',
            table: \Modules\TomatoThemes\App\Tables\FeatureTable::class
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
            model: \Modules\TomatoThemes\App\Models\Feature::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-themes::features.create',
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
            model: \Modules\TomatoThemes\App\Models\Feature::class,
            validation: [
                'title' => 'required',
                'description' => 'nullable',
                'icon' => 'nullable|max:255',
                'icon_color' => 'nullable|max:255',
                'icon_bg_color' => 'nullable|max:255'
            ],
            message: __('Feature updated successfully'),
            redirect: 'admin.features.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoThemes\App\Models\Feature $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoThemes\App\Models\Feature $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-themes::features.show',
        );
    }

    /**
     * @param \Modules\TomatoThemes\App\Models\Feature $model
     * @return View
     */
    public function edit(\Modules\TomatoThemes\App\Models\Feature $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-themes::features.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoThemes\App\Models\Feature $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoThemes\App\Models\Feature $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'title' => 'sometimes',
                'description' => 'nullable',
                'icon' => 'nullable|max:255',
                'icon_color' => 'nullable|max:255',
                'icon_bg_color' => 'nullable|max:255'
            ],
            message: __('Feature updated successfully'),
            redirect: 'admin.features.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoThemes\App\Models\Feature $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoThemes\App\Models\Feature $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Feature deleted successfully'),
            redirect: 'admin.features.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
