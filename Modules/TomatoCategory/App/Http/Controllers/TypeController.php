<?php

namespace Modules\TomatoCategory\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoTranslations\Services\HandelTranslationInput;

class TypeController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: \Modules\TomatoCategory\App\Models\Type::class,
            view: 'tomato-category::types.index',
            table: \Modules\TomatoCategory\App\Tables\TypeTable::class,
            resource: config('tomato-category.types_resource', null),
            filters: [
                "for",
                "type"
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
            model: \Modules\TomatoCategory\App\Models\Type::class,
            filters: [
                'for',
                'type'
            ]
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-category::types.create',
        );
    }

    /**
     * @param \Modules\TomatoCategory\App\Http\Requests\Type\TypeStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\Modules\TomatoCategory\App\Http\Requests\Type\TypeStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoCategory\App\Models\Type::class,
            message: __('Type created successfully'),
            hasMedia: true,
            collection: [
                'image'=>false
            ],
        );

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCategory\App\Models\Type $model
     * @return View
     */
    public function show(\Modules\TomatoCategory\App\Models\Type $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-category::types.show',
            hasMedia: true,
            collection: [
                'image'=>false
            ],
        );
    }

    /**
     * @param \Modules\TomatoCategory\App\Models\Type $model
     * @return View
     */
    public function edit(\Modules\TomatoCategory\App\Models\Type $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-category::types.edit',
            hasMedia: true,
            collection: [
                'image'=>false
            ],
        );
    }

    /**
     * @param \Modules\TomatoCategory\App\Http\Requests\Type\TypeUpdateRequest $request
     * @param \Modules\TomatoCategory\App\Models\Type $user
     * @return RedirectResponse
     */
    public function update(\Modules\TomatoCategory\App\Http\Requests\Type\TypeUpdateRequest $request, \Modules\TomatoCategory\App\Models\Type $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Type updated successfully'),
            redirect: 'admin.types.index',
            hasMedia: true,
            collection: [
                'image'=>false
            ],
        );

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCategory\App\Models\Type $model
     * @return RedirectResponse
     */
    public function destroy(\Modules\TomatoCategory\App\Models\Type $model): RedirectResponse|JsonResponse
    {
        $response =  Tomato::destroy(
            model: $model,
            message: __('Type deleted successfully'),
            redirect: 'admin.types.index',
        );

        return $response->redirect;
    }
}
