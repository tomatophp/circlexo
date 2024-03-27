<?php

namespace Modules\TomatoCms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoCms\App\Transformers\PagesResource;

class PageController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoCms\App\Models\Page::class;
    }

    /**
     * List All Pages
     *
     * get all pages on the system
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-cms::pages.index',
            table: \Modules\TomatoCms\App\Tables\PageTable::class,
            resource: config('tomato-cms.resources.pages.index')
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
            model: \Modules\TomatoCms\App\Models\Page::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-cms::pages.create',
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
            model: \Modules\TomatoCms\App\Models\Page::class,
            validation: [
                'color' => 'nullable|max:255',
                'title' => 'required|array',
                'title*' => 'required|string|max:255',
                'short_description' => 'nullable|array',
                'keywords' => 'nullable|array',
                'slug' => 'required|max:255|string',
                'body' => 'nullable|array',
                'is_active' => 'nullable',
                'has_view' => 'nullable',
                'view' => 'nullable|max:255|string'
            ],
            message: __('Page created successfully'),
            redirect: 'admin.pages.index',
            hasMedia: true,
            collection: [
                "cover" => false,
                "gallery" => true,
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * Get Page Content By Slug
     *
     * you can select a page by slug to view it's content
     *
     * @param \Modules\TomatoCms\App\Models\Page $model
     * @return View|JsonResponse
     */
    public function show($model): View|JsonResponse
    {
        $model = \Modules\TomatoCms\App\Models\Page::where('slug', $model)->orWhere('id', $model)->firstOrFail();
        if($model){
            return Tomato::get(
                model: $model,
                view: 'tomato-cms::pages.show',
                hasMedia: true,
                collection: [
                    "cover" => false,
                    "gallery" => true,
                ],
                resource: config('tomato-cms.resources.pages.show')
            );
        }
        else {
            abort(404);
        }

    }

    /**
     * @param \Modules\TomatoCms\App\Models\Page $model
     * @return View
     */
    public function edit(\Modules\TomatoCms\App\Models\Page $model): View
    {
        $model->short_description = empty($model->short_description) ? ['ar'=>'', 'en'=>''] : $model->short_description;
        $model->keywords = empty($model->keywords) ? ['ar'=>'', 'en'=>''] : $model->keywords;
        $model->body = empty($model->body) ? ['ar'=>'', 'en'=>''] : $model->body;
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::pages.edit',
            hasMedia: true,
            collection: [
                "cover" => false,
                "gallery" => true,
            ]
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoCms\App\Models\Page $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoCms\App\Models\Page $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'color' => 'nullable|max:255',
                'title' => 'sometimes|array',
                'title*' => 'sometimes|string|max:255',
                'short_description' => 'nullable|array',
                'keywords' => 'nullable|array',
                'slug' => 'sometimes|max:255|string',
                'body' => 'nullable|array',
                'is_active' => 'nullable',
                'has_view' => 'nullable',
                'view' => 'nullable|max:255|string'
            ],
            message: __('Page updated successfully'),
            redirect: 'admin.pages.index',
            hasMedia: true,
            collection: [
                "cover" => false,
                "gallery" => true,
            ]
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Page $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoCms\App\Models\Page $model): RedirectResponse|JsonResponse
    {
        if($model->lock){
            Toast::danger(__('Locked Page Can Not Be Deleted'))->autoDismiss(2);
            return back();
        }

        $response = Tomato::destroy(
            model: $model,
            message: __('Page deleted successfully'),
            redirect: 'admin.pages.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
