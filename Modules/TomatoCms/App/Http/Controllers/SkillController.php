<?php

namespace Modules\TomatoCms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class SkillController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoCms\App\Models\Skill::class;
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
            view: 'tomato-cms::skills.index',
            table: \Modules\TomatoCms\App\Tables\SkillTable::class
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
            model: \Modules\TomatoCms\App\Models\Skill::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-cms::skills.create',
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
            model: \Modules\TomatoCms\App\Models\Skill::class,
            validation: [
                'name' => 'required|array',
                'name*' => 'required|max:255|string',
                'description' => 'nullable|array',
                'description*' => 'nullable|max:255|string',
                'exp' => 'required',
                'icon' => 'nullable|max:65535',
                'url' => 'nullable|max:65535'
            ],
            message: __('Skill created successfully'),
            redirect: 'admin.skills.index',
            hasMedia: true,
            collection: [
                "image" => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Skill $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoCms\App\Models\Skill $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::skills.show',
            hasMedia: true,
            collection: [
                "image" => false
            ]
        );
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Skill $model
     * @return View
     */
    public function edit(\Modules\TomatoCms\App\Models\Skill $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::skills.edit',
            hasMedia: true,
            collection: [
                "image" => false
            ]
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoCms\App\Models\Skill $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoCms\App\Models\Skill $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'name' => 'sometimes|array',
                'name*' => 'sometimes|max:255|string',
                'description' => 'nullable|array',
                'description*' => 'nullable|max:255|string',
                'exp' => 'sometimes',
                'icon' => 'nullable|max:65535',
                'url' => 'nullable|max:65535'
            ],
            message: __('Skill updated successfully'),
            redirect: 'admin.skills.index',
            hasMedia: true,
            collection: [
                "image" => false
            ]
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Skill $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoCms\App\Models\Skill $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Skill deleted successfully'),
            redirect: 'admin.skills.index',
            hasMedia: true,
            collection: [
                "image" => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
