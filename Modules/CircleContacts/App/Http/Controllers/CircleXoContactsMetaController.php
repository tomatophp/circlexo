<?php

namespace Modules\CircleContacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\CircleContacts\App\Models\CircleXoContact;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoContactsMetaController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleContacts\App\Models\CircleXoContactsMeta::class;
    }

    /**
     * @return View
     */
    public function create(CircleXoContact $account): View
    {
        if(!has_app('circle-contacts', $account->id)){
            abort(403);
        }

        return Tomato::create(
            view: 'circle-contacts::contacts.meta.create',
            data: [
                'account' => $account,
            ]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request, CircleXoContact $account): RedirectResponse|JsonResponse
    {
        if(!has_app('circle-contacts', $account->id)){
            abort(403);
        }

        $request->merge([
            'contact_id' => $account->id,
        ]);

        $response = Tomato::store(
            request: $request,
            model: \Modules\CircleContacts\App\Models\CircleXoContactsMeta::class,
            validation: [
                'key' => 'required|max:255|string',
                'value' => 'nullable',
            ],
            message: __('Details saved successfully'),
            redirect: 'profile.contacts.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContactsMeta $model
     * @return View
     */
    public function edit(CircleXoContact $account, \Modules\CircleContacts\App\Models\CircleXoContactsMeta $model): View
    {
        if(!has_app('circle-contacts', $account->id)){
            abort(403);
        }
        return Tomato::get(
            model: $model,
            view: 'circle-contacts::contacts.meta.edit',
            data: [
                'account' => $account,
            ]
        );
    }

    /**
     * @param Request $request
     * @param \Modules\CircleContacts\App\Models\CircleXoContactsMeta $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(CircleXoContact $account, Request $request, \Modules\CircleContacts\App\Models\CircleXoContactsMeta $model): RedirectResponse|JsonResponse
    {
        if(!has_app('circle-contacts', $account->id)){
            abort(403);
        }

        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'key' => 'sometimes|max:255|string',
                'value' => 'nullable',
            ],
            message: __('Details updated successfully'),
            redirect: 'profile.contacts.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return back();
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContactsMeta $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(CircleXoContact $account, \Modules\CircleContacts\App\Models\CircleXoContactsMeta $model): RedirectResponse|JsonResponse
    {
        if(!has_app('circle-contacts', $account->id)){
            abort(403);
        }

        $response = Tomato::destroy(
            model: $model,
            message: __('Details deleted successfully'),
            redirect: 'profile.contacts.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }
}
