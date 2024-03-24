<?php

namespace Modules\TomatoCategory\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoTranslations\Services\HandelTranslationInput;

class CategoryController extends Controller
{

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: \Modules\TomatoCategory\App\Models\Category::class,
            view: 'tomato-category::categories.index',
            table: \Modules\TomatoCategory\App\Tables\CategoryTable::class,
            resource: config('tomato-category.categories_resource', null),
            filters: [
                "for"
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
            model: \Modules\TomatoCategory\App\Models\Category::class,
            filters: [
                "for"
            ]
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-category::categories.create',
        );
    }

    /**
     * @param \Modules\TomatoCategory\App\Http\Requests\Category\CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\Modules\TomatoCategory\App\Http\Requests\Category\CategoryStoreRequest $request): RedirectResponse|JsonResponse
    {
        if(!$request->has('slug') || empty($request->slug)) {
            $request->merge(['slug' => Str::slug($request->get('name')[app()->getLocale()])]);
        }
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoCategory\App\Models\Category::class,
            message: __('Category created successfully'),
            redirect: 'admin.categories.index',
            hasMedia: true,
            collection: [
                "image"=>false
            ]
        );

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCategory\App\Models\Category $model
     * @return View
     */
    public function show(\Modules\TomatoCategory\App\Models\Category $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-category::categories.show',
            hasMedia: true,
            collection: [
                "image"=>false
            ]
        );
    }

    /**
     * @param \Modules\TomatoCategory\App\Models\Category $model
     * @return View
     */
    public function edit(\Modules\TomatoCategory\App\Models\Category $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-category::categories.edit',
            hasMedia: true,
            collection: [
                "image"=>false
            ]
        );
    }

    /**
     * @param \Modules\TomatoCategory\App\Http\Requests\Category\CategoryUpdateRequest $request
     * @param \Modules\TomatoCategory\App\Models\Category $user
     * @return RedirectResponse
     */
    public function update(\Modules\TomatoCategory\App\Http\Requests\Category\CategoryUpdateRequest $request, \Modules\TomatoCategory\App\Models\Category $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Category updated successfully'),
            redirect: 'admin.categories.index',
            hasMedia: true,
            collection: [
                "image"=>false
            ]
        );

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCategory\App\Models\Category $model
     * @return RedirectResponse
     */
    public function destroy(\Modules\TomatoCategory\App\Models\Category $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Category deleted successfully'),
            redirect: 'admin.categories.index',
        );

        return $response->redirect;
    }
}
