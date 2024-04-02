<?php

namespace Modules\CircleDocs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoDocController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleDocs\App\Models\CircleXoDoc::class;
    }

    public function like(Request $request)
    {
        $request->validate([
            "type"=> "required|in:page,doc"
        ]);


        if($request->get('type') === 'page')
        {
            $request->validate([
                "id" => "required|exists:circle_xo_docs_pages,id",
            ]);
        }
        else if($request->get('type') === 'doc')
        {
            $request->validate([
                "id" => "required|exists:circle_xo_docs,id",
            ]);
        }

        $model = $request->get('type') === 'doc' ? \Modules\CircleDocs\App\Models\CircleXoDoc::find($request->id) : \Modules\CircleDocs\App\Models\CircleXoDocsPage::find($request->id);
        auth('accounts')->user()->hasLiked($model) ? auth('accounts')->user()->unlike($model) : auth('accounts')->user()->like($model);

        $request->get('type') === 'doc' ? $account = $model->account : $account = $model->doc->account;
        if($account->id !== auth('accounts')->user()->id) {
            $account->notifyDB(
                message: __(auth('accounts')->user()->username . " " . __('is like your docs page') . ' ' . $request->get('type') === 'doc' ? $model->name : $model->title),
                title: __('New Like'),
                url: url(auth('accounts')->user()->username)
            );
        }

        Toast::success(__('Liked successfully'))->autoDismiss(2);
        return back();

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
            view: 'circle-docs::docs.index',
            table: \Modules\CircleDocs\App\Tables\CircleXoDocTable::class
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
            model: \Modules\CircleDocs\App\Models\CircleXoDoc::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circle-docs::docs.create',
        );
    }

    /**
     * @param \Modules\CircleDocs\App\Http\Requests\CircleXoDoc\CircleXoDocStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\Modules\CircleDocs\App\Http\Requests\CircleXoDoc\CircleXoDocStoreRequest $request): RedirectResponse|JsonResponse
    {
        $request->merge([
           'account_id' => auth('accounts')->user()->id,
        ]);

        $response = Tomato::store(
            request: $request,
            model: \Modules\CircleDocs\App\Models\CircleXoDoc::class,
            message: __('Doc saved successfully'),
            redirect: 'profile.docs.index',
            hasMedia: true,
            collection: [
                'icon' => false,
                'cover' => false,
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDoc $model
     * @return View|JsonResponse|RedirectResponse
     */
    public function show(\Modules\CircleDocs\App\Models\CircleXoDoc $model, Request $request): View|JsonResponse|RedirectResponse
    {
        return Tomato::get(
            model: $model,
            view: 'circle-docs::docs.show',
            hasMedia: true,
            collection: [
                'icon' => false,
                'cover' => false,
            ]
        );
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDoc $model
     * @return View
     */
    public function edit(\Modules\CircleDocs\App\Models\CircleXoDoc $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'circle-docs::docs.edit',
            hasMedia: true,
            collection: [
                'icon' => false,
                'cover' => false,
            ]
        );
    }

    /**
     * @param \Modules\CircleDocs\App\Http\Requests\CircleXoDoc\CircleXoDocUpdateRequest $request
     * @param \Modules\CircleDocs\App\Models\CircleXoDoc $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\CircleDocs\App\Http\Requests\CircleXoDoc\CircleXoDocUpdateRequest $request, \Modules\CircleDocs\App\Models\CircleXoDoc $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Doc updated successfully'),
            redirect: 'profile.docs.index',
            hasMedia: true,
            collection: [
                'icon' => false,
                'cover' => false,
            ]
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDoc $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleDocs\App\Models\CircleXoDoc $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Doc deleted successfully'),
            redirect: 'profile.docs.index',
            hasMedia: true,
            collection: [
                'icon' => false,
                'cover' => false,
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
