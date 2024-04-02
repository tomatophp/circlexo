<?php

namespace Modules\CircleDocs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoDocsPagesMetaController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta::class;
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
            view: 'circledocs::circle-xo-docs-pages-metas.index',
            table: \Modules\CircleDocs\App\Tables\CircleXoDocsPagesMetaTable::class
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
            model: \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circledocs::circle-xo-docs-pages-metas.create',
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
            model: \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta::class,
            validation: [
                            'key' => 'required|max:255|string',
            'value' => 'nullable',
            'type' => 'nullable|max:255|string',
            'docs_page_id' => 'required|exists:circle_xo_docs_pages,id'
            ],
            message: __('CircleXoDocsPagesMeta updated successfully'),
            redirect: 'admin.circle-xo-docs-pages-metas.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model
     * @return View|JsonResponse
     */
    public function show(\Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'circledocs::circle-xo-docs-pages-metas.show',
        );
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model
     * @return View
     */
    public function edit(\Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'circledocs::circle-xo-docs-pages-metas.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'key' => 'sometimes|max:255|string',
            'value' => 'nullable',
            'type' => 'nullable|max:255|string',
            'docs_page_id' => 'sometimes|exists:circle_xo_docs_pages,id'
            ],
            message: __('CircleXoDocsPagesMeta updated successfully'),
            redirect: 'admin.circle-xo-docs-pages-metas.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleDocs\App\Models\CircleXoDocsPagesMeta $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('CircleXoDocsPagesMeta deleted successfully'),
            redirect: 'admin.circle-xo-docs-pages-metas.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
