<?php

namespace Modules\CircleDocs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\CircleDocs\App\Models\CircleXoDoc;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoDocsPageController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleDocs\App\Models\CircleXoDocsPage::class;
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
            view: 'circle-docs::docs-pages.index',
            table: \Modules\CircleDocs\App\Tables\CircleXoDocsPageTable::class
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
            model: \Modules\CircleDocs\App\Models\CircleXoDocsPage::class,
        );
    }

    /**
     * @return View
     */
    public function create(Request $request): View
    {
        $request->validate([
           "doc_id" => [ "required",function ($attribute, $value, $fail) use ($request) {
               $exists = CircleXoDoc::query()
                   ->where('account_id', auth('accounts')->user()->id)
                   ->where('id', $request->get('doc_id'))
                   ->first();

               if(!$exists){
                   $fail('The '.$attribute.' is not exists or it is not yours.');
               }
           }],
        ]);

        $doc = CircleXoDoc::find($request->get('doc_id'));

        return Tomato::create(
            view: 'circle-docs::docs-pages.create',
            data: [
                'doc' => $doc,
            ]
        );
    }

    /**
     * @param \Modules\CircleDocs\App\Http\Requests\CircleXoDocsPage\CircleXoDocsPageStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\Modules\CircleDocs\App\Http\Requests\CircleXoDocsPage\CircleXoDocsPageStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\CircleDocs\App\Models\CircleXoDocsPage::class,
            message: __('CircleXoDocsPage updated successfully'),
            redirect: 'profile.docs-pages.index',
            hasMedia: true,
            collection: [
                'cover' => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return redirect()->route('profile.docs-pages.show', $response->record->id);
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPage $model
     * @return View|JsonResponse
     */
    public function show(\Modules\CircleDocs\App\Models\CircleXoDocsPage $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'circle-docs::docs-pages.show',
            hasMedia: true,
            collection: [
                'cover' => false
            ]
        );
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPage $model
     * @return View
     */
    public function edit(\Modules\CircleDocs\App\Models\CircleXoDocsPage $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'circle-docs::docs-pages.edit',
            hasMedia: true,
            collection: [
                'cover' => false
            ]
        );
    }

    /**
     * @param \Modules\CircleDocs\App\Http\Requests\CircleXoDocsPage\CircleXoDocsPageUpdateRequest $request
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPage $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\CircleDocs\App\Http\Requests\CircleXoDocsPage\CircleXoDocsPageUpdateRequest $request, \Modules\CircleDocs\App\Models\CircleXoDocsPage $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('CircleXoDocsPage updated successfully'),
            redirect: 'profile.docs-pages.index',
            hasMedia: true,
            collection: [
                'cover' => false
            ]
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return redirect()->route('profile.docs-pages.show', $response->record->id);
    }

    /**
     * @param \Modules\CircleDocs\App\Models\CircleXoDocsPage $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleDocs\App\Models\CircleXoDocsPage $model): RedirectResponse|JsonResponse
    {
        $doc = $model->doc->id;
        $response = Tomato::destroy(
            model: $model,
            message: __('CircleXoDocsPage deleted successfully'),
            redirect: 'profile.docs-pages.index',
            hasMedia: true,
            collection: [
                'cover' => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return redirect()->route('profile.docs.show', $doc->id);
    }
}
