<?php

namespace Modules\CircleApps\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class AppController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleApps\App\Models\App::class;
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
            view: 'circle-apps::apps.index',
            table: \Modules\CircleApps\App\Tables\AppTable::class
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
            model: \Modules\CircleApps\App\Models\App::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circle-apps::apps.create',
        );
    }

    /**
     * @param \Modules\CircleApps\App\Http\Requests\App\AppStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\Modules\CircleApps\App\Http\Requests\App\AppStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\CircleApps\App\Models\App::class,
            message: __('App updated successfully'),
            redirect: 'admin.apps.index',
            hasMedia: true,
            collection: [
                'logo' => false,
                'cover' => false,
            ]
        );

        $response->record->categories()->sync($request->categories);

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\CircleApps\App\Models\App $model
     * @return View|JsonResponse
     */
    public function show(\Modules\CircleApps\App\Models\App $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'circle-apps::apps.show',
            hasMedia: true,
            collection: [
                'logo' => false,
                'cover' => false,
            ]
        );
    }

    /**
     * @param \Modules\CircleApps\App\Models\App $model
     * @return View
     */
    public function edit(\Modules\CircleApps\App\Models\App $model): View
    {
        $model->categories = $model->categories->pluck('id')->toArray();
        return Tomato::get(
            model: $model,
            view: 'circle-apps::apps.edit',
            hasMedia: true,
            collection: [
                'logo' => false,
                'cover' => false,
            ]
        );
    }

    /**
     * @param \Modules\CircleApps\App\Http\Requests\App\AppUpdateRequest $request
     * @param \Modules\CircleApps\App\Models\App $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\CircleApps\App\Http\Requests\App\AppUpdateRequest $request, \Modules\CircleApps\App\Models\App $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('App updated successfully'),
            redirect: 'admin.apps.index',
            hasMedia: true,
            collection: [
                'logo' => false,
                'cover' => false,
            ]
        );

        $response->record->categories()->sync($request->categories);

        if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\CircleApps\App\Models\App $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleApps\App\Models\App $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('App deleted successfully'),
            redirect: 'admin.apps.index',
            hasMedia: true,
            collection: [
                'logo' => false,
                'cover' => false,
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    public function download(Request $request, \Modules\CircleApps\App\Models\App $model)
    {
        $file = $model->getMedia('module')->first();

        return response()->download($file->getPath());
    }
}
