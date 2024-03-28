<?php

namespace Modules\TomatoEcommerce\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class SearchController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoEcommerce\App\Models\Search::class;
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
            view: 'tomato-ecommerce::searches.index',
            table: \Modules\TomatoEcommerce\App\Tables\SearchTable::class
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
            model: \Modules\TomatoEcommerce\App\Models\Search::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-ecommerce::searches.create',
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
            model: \Modules\TomatoEcommerce\App\Models\Search::class,
            validation: [
                            'search' => 'required|max:255|string',
            'count' => 'nullable'
            ],
            message: __('Search updated successfully'),
            redirect: 'admin.searches.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Search $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoEcommerce\App\Models\Search $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-ecommerce::searches.show',
        );
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Search $model
     * @return View
     */
    public function edit(\Modules\TomatoEcommerce\App\Models\Search $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-ecommerce::searches.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoEcommerce\App\Models\Search $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoEcommerce\App\Models\Search $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'search' => 'sometimes|max:255|string',
            'count' => 'nullable'
            ],
            message: __('Search updated successfully'),
            redirect: 'admin.searches.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Search $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoEcommerce\App\Models\Search $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Search deleted successfully'),
            redirect: 'admin.searches.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
